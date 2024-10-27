<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class QrController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        return view('frontend.qr.receiveQr' , compact('user'));
    }

    public function scanPage()
    {
        // $user = Auth::user();

        return view('frontend.qr.scanPage');
    }
}
