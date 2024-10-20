<?php
namespace App\Helpers;

use App\Models\Wallet;

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
}
?>
