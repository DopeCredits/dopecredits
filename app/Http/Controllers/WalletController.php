<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Soneso\StellarSDK\StellarSDK;

class WalletController extends Controller
{
    private $sdk;

    public function __construct()
    {
        $this->sdk = StellarSDK::getPublicNetInstance();
    }

    public function store(Request $request)
    {
        if (empty($request->public) || empty($request->wallet)) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong!']);
        }

        try {
            $this->sdk->requestAccount($request->public);
        } catch (Exception $th) {
            return response()->json(['status' => 0, 'msg' => 'Deposit 5 XLM lumens into your wallet!']);
        }

        $data = [
            'public' => $request->public,
            'wallet' => $request->wallet
        ];



        return response()->json(['public' => $request->public]);
    }
}
