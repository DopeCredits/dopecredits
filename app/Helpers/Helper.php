<?php


function ansrBalance($accountID)
{

    $sdk = Soneso\StellarSDK\StellarSDK::getPublicNetInstance();

    $account = $sdk->requestAccount($accountID);

    $balance = 0;

    foreach ($account->getBalances() as $bal) {
        if ($bal->getAssetCode() == 'ANSR') {
            if ($bal->getBalance()) {
                $balance = $bal->getBalance();
                break;
            }
        }
    }

    return $balance;
}

function balanceComma($number = 1234.56)
{
    $number = number_format($number, 2, '.', ',');
    return $number;
}
