<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Wallet;
use App\Notifications\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class UserWalletController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user('web');

        $wallet = Wallet::where('user_id' ,$user->id)->first();

        return view('frontend.wallet.index' , compact(['user' , 'wallet']));
    }

    public function userHomePage()
    {
        $user = Auth::user('web');

        $wallet = Wallet::where('user_id' ,$user->id)->first();

        return view('dashboard' , compact(['user' , 'wallet']));
    }
}

