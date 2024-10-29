<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::where('source_id', Auth::user()->id)
                ->with('user', 'source')
                ->orderBy('created_at', 'DESC');
            // Apply filter if it exists in the request
            if ($request->has('filter') && $request->input('filter') !== 'all') {
                $query->where('type', $request->input('filter')); // Adjust 'type' to fit your filtering field
            }
            // Paginate results
            $transactions = $query->paginate(5);

        if ($request->ajax()) {
            $view = view('frontend.components.paginate', compact('transactions'))->render();

            return response()->json(['html' => $view]);
        }

        return view('frontend.transaction.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        return view('frontend.transaction.show', compact('transaction'));
    }

}
