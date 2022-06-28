<?php

namespace App\Http\Controllers;

use App\Models\Staking;
use App\Models\StakingResult;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
        $this->minAmount = env('MIN_AMOUNT');
        $this->returnDays = env('RETURN_DAYS');
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
            return response()->json(['status' => 0, 'msg' => 'Deposit 5 XLM lumens into your wallet!']);
        }

        $ansr = null;
        $lowAmount = null;

        foreach ($account->getBalances() as $bal) {
            if ($bal->getAssetCode() == 'ANSR') {
                $ansr = 1;
                if ($bal->getBalance() < $this->minAmount) {
                    $lowAmount = 1;
                }
            }
        }

        if (!$ansr) {
            return response()->json(['status' => 0, 'msg' => 'Account does not have ANSR trusline!']);
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

        return response()->json(['lowAmount' => $lowAmount, 'balance' => balanceComma(ansrBalance($request->public)), 'public' => $request->public, 'msg' => 'Connection successfull!', 'status' => 1]);
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
            return response()->json(['status' => 0, 'msg' => 'Deposit 5 XLM lumens into your wallet!']);
        }

        $ansr = null;
        $lowAmount = null;

        foreach ($account->getBalances() as $bal) {
            if ($bal->getAssetCode() == 'ANSR') {
                $ansr = 1;
                if ($bal->getBalance() < $this->minAmount) {
                    $lowAmount = 1;
                }
            }
        }

        if (!$ansr) {
            return response()->json(['status' => 0, 'msg' => 'Account does not have ANSR trusline!']);
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

        return response()->json(['lowAmount' => $lowAmount, 'balance' => balanceComma(ansrBalance($keypair->getAccountId())), 'public' => $keypair->getAccountId(), 'msg' => 'Connection successfull!', 'status' => 1]);
    }

    public function disconnect()
    {
        Cookie::queue(Cookie::forget('public'));
        Cookie::queue(Cookie::forget('wallet'));
        return redirect('/staking');
    }

    // staking XDR GENERATE
    public function staking(Request $request)
    {
        if (!isset($_COOKIE['public'])) {
            return response()->json(['status' => 0, 'msg' => 'Wallet Address not Found!']);
        }
        $wallet = Wallet::where('public', $_COOKIE['public'])->first();

        // Check Stellar Account
        try {
            $account = $this->sdk->requestAccount($_COOKIE['public']);
        } catch (Exception $th) {
            return response()->json(['status' => 0, 'msg' => 'Deposit 5 XLM lumens into your wallet!']);
        }

        $ansr = null;
        $lowAmount = null;

        foreach ($account->getBalances() as $bal) {
            if ($bal->getAssetCode() == 'ANSR') {
                $ansr = 1;
                if ($bal->getBalance() < $request->amount) {
                    $lowAmount = 1;
                }
            }
        }

        if (!$ansr) {
            return response()->json(['status' => 0, 'msg' => 'Account does not have ANSR trusline!']);
        }

        if ($lowAmount) {
            return response()->json(['status' => 0, 'msg' => 'Not enough ANSR Tokens!']);
        }

        $data = array(
            'public' => $_COOKIE['public'],
            'amount' => $request->amount,
            'status' => 0
        );

        $staking = Staking::create($data);

        if (empty($wallet->secret)) {
            $xdr = $this->stakePublic($wallet, $request->amount);
        } else {
            $xdr = $this->stakeSecret($wallet, $request->amount);
        }

        // Operation failed
        if (!$xdr) {
            $staking->delete();
            return response()->json(['status' => 0, 'msg' => 'Something went wrong!']);
        }

        return response()->json(['xdr' => $xdr, 'status' => 1, 'staking_id' => $staking->id]);
    }

    private function stakePublic($wallet, $amount)
    {
        try {

            // Destination Account
            $mainSecret = env('MAIN_WALLET');
            $mainPair = KeyPair::fromSeed($mainSecret);

            $account = $this->sdk->requestAccount($wallet->public);

            $assetCode = 'ANSR';
            $assetIssuer = 'GAEQFO7DDXQCJ4REZX6M6ULRNCI7WBXTJPMJRRWZQBA3C5T3LAWL7CQO';
            $asset = new AssetTypeCreditAlphanum4($assetCode, $assetIssuer);
            // Payment Operation
            $paymentOperation = (new PaymentOperationBuilder($mainPair->getAccountId(), $asset, $amount))->build();
            $txbuilder = new TransactionBuilder($account);
            $txbuilder->setMaxOperationFee($this->maxFee);
            $transaction = $txbuilder->addOperation($paymentOperation)->addMemo(new Memo(1, 'ANSR staking'))->build();
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

            $assetCode = 'ANSR';
            $assetIssuer = 'GAEQFO7DDXQCJ4REZX6M6ULRNCI7WBXTJPMJRRWZQBA3C5T3LAWL7CQO';
            $asset = new AssetTypeCreditAlphanum4($assetCode, $assetIssuer);
            // Payment Operation
            $paymentOperation = (new PaymentOperationBuilder($mainPair->getAccountId(), $asset, $amount))->build();
            $txbuilder = new TransactionBuilder($account);
            $txbuilder->setMaxOperationFee($this->maxFee);
            $transaction = $txbuilder->addOperation($paymentOperation)->addMemo(new Memo(1, 'ANSR staking'))->build();
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
        $staking = Staking::where('id', $request->staking_id)->first();
        if (!$staking) {
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
                $staking->transaction_id = $txID;
                $staking->save();
            }
            return response()->json(['status' => 1, 'msg' => 'Success!']);
        } catch (\Throwable $th) {
            $staking->delete();
            return response()->json(['status' => 0, 'msg' => 'Failed!']);
        }
    }

    public function stakingresult()
    {
        // removes NULL
        Staking::whereNull('transaction_id')->delete();

        $stakings =  Staking::whereNotNull('transaction_id')
            ->where('status', 0)
            // ->whereRaw('MINUTE(created_at) < 60')
            // ->where('created_at', '<=', now()->subDays($this->returnDays)->endOfDay())
            ->get();

        // Looping through staking
        foreach ($stakings as $key => $staking) {
            $result = $this->returnStaking($staking);
            if ($result) {
                $staking->status = 1;
                $staking->save();
                StakingResult::create(['staking_id' => $staking->id, 'amount' => $result->amount, 'transaction_id' => $result->tx]);
            }
        }
        return response()->json([$stakings]);
    }

    private function returnStaking($staking)
    {
        $amount = $staking->amount + (($staking->amount / 100) * 2);
        try {
            // Destination Account
            $mainSecret = env('MAIN_WALLET');
            $mainPair = KeyPair::fromSeed($mainSecret);

            $mainAccount = $this->sdk->requestAccount($mainPair->getAccountId());
            $account = $this->sdk->requestAccount($staking->public);

            $assetCode = 'ANSR';
            $assetIssuer = 'GAEQFO7DDXQCJ4REZX6M6ULRNCI7WBXTJPMJRRWZQBA3C5T3LAWL7CQO';
            $asset = new AssetTypeCreditAlphanum4($assetCode, $assetIssuer);
            // Payment Operation
            $paymentOperation = (new PaymentOperationBuilder($account->getAccountId(), $asset, $amount))->build();
            $txbuilder = new TransactionBuilder($mainAccount);
            $txbuilder->setMaxOperationFee($this->maxFee);
            $transaction = $txbuilder->addOperation($paymentOperation)->addMemo(new Memo(1, 'ANSR staking Return'))->build();
            $transaction->sign($mainPair, Network::public());
            $res = $this->sdk->submitTransaction($transaction);
            return (object)['tx' => $res->getId(), 'amount' => $amount];
        } catch (\Throwable $th) {
            return null;
        }
    }
}
