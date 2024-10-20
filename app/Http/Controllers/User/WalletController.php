<?php

namespace App\Http\Controllers\User;

use DataTables;
use Carbon\Carbon;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Wallet::with('user');

            return Datatables::of($data)
                    ->addColumn('user_info' ,function ($each){
                        $user = $each->user;
                        if($user){
                            return "<p class='block'>Name : $user->name</p> . <p class='block'>Email : $user->email</p> . <p class='block'>Phone : $user->phone</p>";
                        }
                    })
                    ->editColumn('amount' , function($each){
                        return number_format($each->amount ,2);
                    })
                    ->editColumn('created_at' , function($each){
                        return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
                    })
                    ->editColumn('updated_at' , function($each){
                        return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
                    })
                    ->filterColumn('user_info', function ($query, $keyword) {
                        $query->whereHas('user', function ($query) use ($keyword) {
                            $query->where('name', 'like', "%{$keyword}%");
                            $query->orWhere('email', 'like', "%{$keyword}%");
                            $query->orWhere('phone', 'like', "%{$keyword}%");
                        });
                    })
                    ->rawColumns(['user_info'])
                    ->make(true);
        }

        return view('admin.wallet.index');
    }
}
