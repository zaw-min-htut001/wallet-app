<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::where('source_id' , Auth::user()->id)->with('user' , 'source')->orderBy('created_at','DESC')->paginate(5);

        if ($request->ajax()) {
            $view = view('frontend.components.paginate', compact('transactions'))->render();

            return response()->json(['html' => $view]);
        }

        return view('frontend.transaction.index', compact('transactions'));
    }
}
