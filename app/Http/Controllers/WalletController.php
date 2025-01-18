<?php

namespace App\Http\Controllers;

use App\Models\Staking;
use App\Models\StakingResult;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Soneso\StellarSDK\AssetTypeCreditAlphanum4;
use Soneso\StellarSDK\Crypto\KeyPair;
use Soneso\StellarSDK\Memo;
use Soneso\StellarSDK\Network;
use Soneso\StellarSDK\PaymentOperationBuilder;
use Soneso\StellarSDK\Signer;
use Soneso\StellarSDK\StellarSDK;
use Soneso\StellarSDK\Transaction;
use Soneso\StellarSDK\TransactionBuilder;
use Soneso\StellarSDK\Xdr\XdrDecoratedSignature;
use Soneso\StellarSDK\Xdr\XdrSigner;

class WalletController extends Controller
{
    private $sdk, $minAmount, $maxFee, $returnDays;

    public function __construct()
    {
        $this->sdk = StellarSDK::getPublicNetInstance();
        // $this->sdk = StellarSDK::getTestNetInstance();
        $this->minAmount = 10;
        $this->returnDays = 1;
        $this->maxFee = 3000;
    }

    public function store(Request $request)
    {
        if (empty($request->public) || empty($request->wallet)) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong!']);
        }

        // Check Stellar Account
        try {
            $account = $this->sdk->requestAccount($request->public);
        } catch (Exception $th) {
            return response()->json(['status' => 0, 'msg' => 'Deposit 5 XLM lumens into your wallet']);
        }

        $dope = null;
        $lowAmount = null;

        foreach ($account->getBalances() as $bal) {
            if ($bal->getAssetCode() == 'DOPE') {
                $dope = 1;
                if ($bal->getBalance() < $this->minAmount) {
                    $lowAmount = 1;
                }
            }
        }

        if (!$dope) {
            return response()->json(['status' => 0, 'msg' => 'Account does not have DOPE trusline!']);
        }

        $data = [
            'public' => $request->public,
            'wallet' => $request->wallet
        ];

        // Store Stellar Account if not exist
        $wallet = Wallet::where('public', $request->public)->first();
        
        if (!$wallet) {
            Wallet::create($data);
        } else {
            $wallet->update($data);
        }

        setcookie('public', $request->public, time() + (86400 * 30), "/");
        setcookie('wallet', $request->wallet, time() + (86400 * 30), "/");


        return response()->json(['lowAmount' => $lowAmount, 'balance' => balanceComma(dopeBalance($request->public)), 'public' => $request->public, 'msg' => 'Connection successfull!', 'status' => 1]);
    }

    public function secret(Request $request)
    {
        if (empty($request->key)) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong!']);
        }

        $keypair = KeyPair::fromSeed($request->key);

        // Check Stellar Account
        try {
            $account = $this->sdk->requestAccount($keypair->getAccountId());
        } catch (Exception $th) {
            return response()->json(['status' => 0, 'msg' => 'Deposit 5 XLM lumens into your wallet']);
        }

        $dope = null;
        $lowAmount = null;

        foreach ($account->getBalances() as $bal) {
            if ($bal->getAssetCode() == 'DOPE') {
                $dope = 1;
                if ($bal->getBalance() < $this->minAmount) {
                    $lowAmount = 1;
                }
            }
        }

        if (!$dope) {
            return response()->json(['status' => 0, 'msg' => 'Account does not have DOPE trusline!']);
        }

        $data = [
            'secret' => $request->key,
            'public' => $keypair->getAccountId(),
            'wallet' => 'privatekey'
        ];

        // Store Stellar Account if not exist
        $wallet = Wallet::where('public', $keypair->getAccountId())->first();
        if (!$wallet) {
            Wallet::create($data);
        } else {
            $wallet->update($data);
        }

        setcookie('public', $keypair->getAccountId(), time() + (86400 * 30), "/");
        setcookie('wallet', 'privatekey', time() + (86400 * 30), "/");

        return response()->json(['lowAmount' => $lowAmount, 'balance' => balanceComma(dopeBalance($keypair->getAccountId())), 'public' => $keypair->getAccountId(), 'msg' => 'Connection successfull!', 'status' => 1]);
    }

    public function disconnect()
    {
        Cookie::queue(Cookie::forget('public'));
        Cookie::queue(Cookie::forget('wallet'));
        return redirect('/');
    }

    // invest XDR GENERATE
    public function invest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'integer', 'min:1000'],
        ], [
            'amount.required' => 'The amount field is required.',
            'amount.integer' => 'The amount must be a valid number.',
            'amount.min' => 'The amount must be at least 1000.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'msg' => 'Validation error!',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        if (!isset($_COOKIE['public'])) {
            return response()->json(['status' => 0, 'msg' => 'Wallet not connected!']);
        }
        
        $wallet = Wallet::where('public', $_COOKIE['public'])->first(); 
        if (!$wallet) {
            return response()->json(['status' => 0, 'msg' => 'Wallet not found!']);
        }
        
        // Check Stellar Account
        $account = $this->sdk->requestAccount($_COOKIE['public']);
        if(!$account){
            return response()->json(['status' => 0, 'msg' => 'Not enough XLM in your wallet!']);
        }

        // Validate DOPE balance and trustline
        $hasTrustline = false;
        $hasSufficientBalance = false;
        foreach ($account->getBalances() as $balance) {
            if ($balance->getAssetCode() === 'DOPE') {
                $hasTrustline = true;
                if ($balance->getBalance() >= $request->amount) {
                    $hasSufficientBalance = true;
                }
                break;
            }
        }

        if (!$hasTrustline) {
            return response()->json(['status' => 0, 'msg' => 'Wallet does not have DOPE trustline!']);
        }

        if (!$hasSufficientBalance) {
            return response()->json(['status' => 0, 'msg' => 'Not enough DOPE Tokens!']);
        }

        // $wallet = Wallet::where('public', $_COOKIE['public'])->first();

        // $data = array(
        //     'public' => $_COOKIE['public'],
        //     'amount' => $request->amount,
        //     'status' => 0
        // );

        // $invest = Staking::create($data);

        // if (empty($wallet->secret)) {
        //     $xdr = $this->stakePublic($wallet, $request->amount);
        // } else {
        //     $xdr = $this->stakeSecret($wallet, $request->amount);
        // }

        // // Operation failed
        // if (!$xdr) {
        //     $invest->delete();
        //     return response()->json(['status' => 0, 'msg' => 'Something went wrong!']);
        // }

        // return response()->json(['xdr' => $xdr, 'status' => 1, 'staking_id' => $invest->id]);

        DB::beginTransaction();

        try {
            $existing_staking = Staking::where('public', $_COOKIE['public'])->where('status', 0)->where('amount', '=>', 1000)->first();
            if($existing_staking){
                $existing_staking->amount += $request->amount;
                $existing_staking->save();
            }

            else{
                $new_stake = new Staking();
                $new_stake->public = $_COOKIE['public'];
                $new_stake->status = 0;
                $new_stake->amount = $request->amount;
                $new_stake->save();
            }
    
            if (empty($wallet->secret)) {
                $xdr = $this->stakePublic($wallet, $request->amount);
            } else {
                $xdr = $this->stakeSecret($wallet, $request->amount);
            }
    
            // Operation failed
            if (!$xdr) {
                throw new \Exception('Something went wrong during staking operation.');
            }
            
            DB::commit(); // Commit the transaction
            return response()->json(['xdr' => $xdr, 'status' => 1, 'staking_id' => $existing_staking ? $existing_staking->id : $new_stake->id]);

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction
    
            // Delete the staking record if it was created
            // if (isset($invest)) {
            //     $invest->delete();
            // }
    
            return response()->json(['status' => 0, 'msg' => $e->getMessage()]);
        }
    }

    private function stakePublic($wallet, $amount)
    {
        try {

            // Destination Account
            $mainSecret = env('MAIN_WALLET');
            $mainPair = KeyPair::fromSeed($mainSecret);

            $account = $this->sdk->requestAccount($wallet->public);
            
            $assetCode = 'DOPE';
            $assetIssuer = 'GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B';
            $asset = new AssetTypeCreditAlphanum4($assetCode, $assetIssuer);
            // Payment Operation
            $paymentOperation = (new PaymentOperationBuilder($mainPair->getAccountId(), $asset, $amount))->build();
            $txbuilder = new TransactionBuilder($account);
            $txbuilder->setMaxOperationFee($this->maxFee);
            $transaction = $txbuilder->addOperation($paymentOperation)->addMemo(new Memo(1, 'DOPE staking'))->build();
            $signer = Signer::preAuthTx($transaction, Network::public());
            $sk = new XdrSigner($signer, 1);
            $transaction->addSignature(new XdrDecoratedSignature('sign', $sk->encode()));
            $response = $transaction->toEnvelopeXdrBase64();

            return $response;
        } catch (\Throwable $th) {
            return null;
        }
    }

    private function stakeSecret($wallet, $amount)
    {
        try {

            // Destination Account
            $mainSecret = env('MAIN_WALLET');
            $mainPair = KeyPair::fromSeed($mainSecret);

            $account = $this->sdk->requestAccount($wallet->public);
            $sourcePair = KeyPair::fromSeed($wallet->secret);

            $assetCode = 'DOPE';
            $assetIssuer = 'GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B';
            $asset = new AssetTypeCreditAlphanum4($assetCode, $assetIssuer);
            // Payment Operation
            $paymentOperation = (new PaymentOperationBuilder($mainPair->getAccountId(), $asset, $amount))->build();
            $txbuilder = new TransactionBuilder($account);
            $txbuilder->setMaxOperationFee($this->maxFee);
            $transaction = $txbuilder->addOperation($paymentOperation)->addMemo(new Memo(1, 'DOPE staking'))->build();
            $transaction->sign($sourcePair, Network::public());
            $response = $transaction->toEnvelopeXdrBase64();

            return $response;
        } catch (\Throwable $th) {
            return null;
        }
    }

    // XDR SUBMIT
    public function submitXdr(Request $request)
    {
        $xdr = $request->xdr;
        $invest = Staking::where('id', $request->staking_id)->first();
        if (!$invest) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong!']);
        }
        try {
            $sdk = $this->sdk;
            $tx = Transaction::fromEnvelopeBase64XdrString($xdr);
            if (!empty($tx->getSignatures()[1])) {
                $tx->setSignatures([$tx->getSignatures()[1]]);
            }
            $result = $sdk->submitTransaction($tx);
            $txID = $result->getId();
            if ($txID) {
                $invest->transaction_id = $txID;
                $invest->save();
            }
            return response()->json(['status' => 1, 'msg' => 'Success!']);
        } catch (\Throwable $th) {
            // $invest->delete();
            return response()->json(['status' => 0, 'msg' => 'Failed!']);
        }
    }


    public function stop_staking($wallet_address = null)
    {
        if ($wallet_address) {
            $public_key = $wallet_address;

            $wallets = Staking::where('public', $public_key)
                ->where('amount', '>=', 1000)
                ->where('status', 0)
                ->whereNotNull('transaction_id')
                ->get();

            if ($wallets->isEmpty()) {
                return response()->json(['status' => 0, 'msg' => 'Wallet not found!']);
            }

            $amount = $wallets->sum('amount');

            try {
                // Destination Account
                $mainSecret = env('DISTRIBUTION_WALLET');
                $mainPair = KeyPair::fromSeed($mainSecret);

                $mainAccount = $this->sdk->requestAccount($mainPair->getAccountId());
                $account = $this->sdk->requestAccount($public_key);

                $assetCode = 'DOPE';
                $assetIssuer = 'GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B';
                $asset = new AssetTypeCreditAlphanum4($assetCode, $assetIssuer);

                // Payment Operation
                $paymentOperation = (new PaymentOperationBuilder($account->getAccountId(), $asset, $amount))->build();
                $txbuilder = new TransactionBuilder($mainAccount);
                $txbuilder->setMaxOperationFee($this->maxFee);
                $transaction = $txbuilder->addOperation($paymentOperation)->addMemo(Memo::text('DOPE Stake Return'))->build();
                $transaction->sign($mainPair, Network::public());
                $res = $this->sdk->submitTransaction($transaction);

                foreach ($wallets as $wallet) {
                    $wallet->status = 1;
                    $wallet->save();
                }

                return response()->json(['status' => 1, 'msg' => 'Success', 'tx' => $res->getId()]);
            } catch (\Throwable $th) {
                \Log::error('Stop Staking Error: ' . $th->getMessage());
                return response()->json(['status' => 0, 'msg' => 'An error occurred while processing the transaction.']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Wallet address not provided!']);
        }
    }

    public function investresult()
    {
        // removes NULL
        Staking::whereNull('transaction_id')->delete();

        $invests = Staking::whereNotNull('transaction_id')
            ->where('amount', '>=' ,1000)
            ->where('status', 0)
            // ->where('updated_at', '<=', now()->subDays($this->returnDays)->endOfDay())
            ->get();

        // Looping through invest
        foreach ($invests as $key => $invest) {
            $result = $this->returnStaking($invest);
            if ($result) {
                // $invest->status = 1;
                // $invest->save();
                StakingResult::create(['staking_id' => $invest->id, 'amount' => $result->amount, 'transaction_id' => $result->tx]);
            }
        }
        return response()->json([$invests]);
    }

    private function returnStaking($invest)
    {
        $daily_rate = 0.06395 / 100;
        $amount = $daily_rate * $invest->amount;
        try {
            // Destination Account
            $mainSecret = env('DISTRIBUTION_WALLET');
            $mainPair = KeyPair::fromSeed($mainSecret);

            $mainAccount = $this->sdk->requestAccount($mainPair->getAccountId());
            $account = $this->sdk->requestAccount($invest->public);

            $assetCode = 'DOPE';
            $assetIssuer = 'GA5J25LV64MUIWVGWMMOTNPEKEZTXDDCCZNNPHTSGAIHXHTPMR3NLD4B';
            $asset = new AssetTypeCreditAlphanum4($assetCode, $assetIssuer);

            // Payment Operation
            $paymentOperation = (new PaymentOperationBuilder($account->getAccountId(), $asset, $amount))->build();
            $txbuilder = new TransactionBuilder($mainAccount);
            $txbuilder->setMaxOperationFee($this->maxFee);
            $transaction = $txbuilder->addOperation($paymentOperation)->addMemo(new Memo(1, 'DOPE Stake Reward'))->build();
            $transaction->sign($mainPair, Network::public());
            $res = $this->sdk->submitTransaction($transaction);
            return (object)['tx' => $res->getId(), 'amount' => $amount];
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function fetch_dashboard_data() {

        $account = $this->sdk->requestAccount('GBAXVSMRA5YDYT3HSHBWTNRFCX6E6DZO7IKSIFDBKYGIRPYL4QP2TJ64');
        
        $unlocked_tokens = 0;

        foreach ($account->getBalances() as $bal) {
            if ($bal->getAssetCode() == 'DOPE') {
                $unlocked_tokens = 700000000 - $bal->getBalance();
            }
        }

        $data = StakingResult::Join('stakings as s' ,'s.id', 'staking_results.staking_id')
        ->orderBy('staking_results.updated_at', 'desc')
        ->select(
            'staking_results.amount as reward', 
            'staking_results.transaction_id as explorer_link', 
            's.public as wallet_address', 
            's.amount as staked_amount' // Assuming `amount` represents staked amount in the `stakings` table
        )
        ->orderBy('staking_results.updated_at', 'desc')
        ->get();

        $total_stakers = Staking::whereNotNull('transaction_id')
        ->distinct('public')
        ->count('public'); // Assuming `public` is the identifier for stakers

        // Sum the amount where transaction_id is not null
        $total_staked = Staking::whereNotNull('transaction_id')
        ->sum('amount'); // Assuming `amount` is the column holding staked values

        return response()->json([
            'data' => $data,
            'total_stakers' => $total_stakers,
            'total_staked' => $total_staked,
            'unlocked_tokens' => $unlocked_tokens,
        ]);
        
    }

    public function fetch_wallet_data($wallet_address = null){
        if ($wallet_address) {
            $staked = Staking::whereNotNull('transaction_id')
            ->where('public', $wallet_address)
            ->sum('amount'); // Assuming `amount` is the staked amount column
    
            // Sum the amount where transaction_id is not null
            $total_reward_received = StakingResult::join('stakings as s', 's.id', '=', 'staking_results.staking_id')
            ->whereNotNull('staking_results.transaction_id')
            ->where('s.public', $wallet_address)
            ->sum('staking_results.amount'); // Sum of rewards
    
            return response()->json([
                'staked' => $staked,
                'total_reward_received' => $total_reward_received,
            ]);
        } else {
            return response()->json(['message' => 'No wallet address provided']);
        }
    }
}
