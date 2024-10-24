<?php
namespace App\Helpers;

use App\Models\Wallet;
use App\Models\Transaction;

class UUIDGenerate
{
    public static function accountNumberGenerate()
    {
        $accountNumber =  mt_rand('00000000000' , '99999999999');

        if(Wallet::where('account_number' ,$accountNumber )->exists()){
            self::accountNumberGenerate();
        }
        return $accountNumber;
    }

    public static function refNumberGenerate()
    {
        $refNumber =  mt_rand('00000000000' , '99999999999');

        if(Transaction::where('ref_no' ,$refNumber )->exists()){
            self::refNumberGenerate();
        }
        return $refNumber;
    }

    public static function transactionIdGenerate()
    {
        $transactionId =  mt_rand('00000000000' , '99999999999');

        if(Transaction::where('transcation_id' ,$transactionId )->exists()){
            self::transactionIdGenerate();
        }
        return $transactionId;
    }
}
?>
