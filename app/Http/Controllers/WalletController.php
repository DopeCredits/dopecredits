<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Soneso\StellarSDK\Crypto\KeyPair;
use Soneso\StellarSDK\StellarSDK;

class WalletController extends Controller
{
    private $sdk, $min;

    public function __construct()
    {
        $this->sdk = StellarSDK::getPublicNetInstance();
        $this->minAmount = 100;
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

        if ($lowAmount) {
            return response()->json(['status' => 0, 'msg' => 'Account has below mininum requiement of ANSR!']);
        }

        $data = [
            'public' => $request->public,
            'wallet' => $request->wallet
        ];

        // Store Stellar Account if not exist
        $wallet = Wallet::where('public', $request->public)->first();
        if (!$wallet) {
            Wallet::create($data);
        }

        setcookie('public', $request->public, time() + (86400 * 30), "/");

        return response()->json(['balance' => balanceComma(ansrBalance($request->public)), 'public' => $request->public, 'msg' => 'Connection successfull!', 'status' => 1]);
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

        if ($lowAmount) {
            return response()->json(['status' => 0, 'msg' => 'Account has below mininum requiement of ANSR!']);
        }

        $data = [
            'secret' => $request->key,
            'public' => $keypair->getAccountId(),
            'wallet' => 'secret'
        ];

        // Store Stellar Account if not exist
        $wallet = Wallet::where('public', $keypair->getAccountId())->first();
        if (!$wallet) {
            Wallet::create($data);
        }

        setcookie('public', $keypair->getAccountId(), time() + (86400 * 30), "/");

        return response()->json(['balance' => balanceComma(ansrBalance($keypair->getAccountId())), 'public' => $keypair->getAccountId(), 'msg' => 'Connection successfull!', 'status' => 1]);
    }
}
