<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        $notifications = $user->notifications;

        return view('frontend.noti.mynoti', compact('notifications'));
    }

    public function show($notification)
    {
        $user = Auth::user();

        $notification = $user->notifications()->where('id' , $notification)->first();

        $notification->markAsRead();

        return view('frontend.noti.show', compact('notification'));
    }
}
