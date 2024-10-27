<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\UUIDGenerate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreTransactionRequest;

class TransferController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user('web');

        $wallet = Wallet::where('user_id' ,$user->id)->first();

        return view('frontend.transfer.index' , compact(['user' , 'wallet']));
    }

    public function verifyNumber(Request $request)
    {
        if(!$request->phone_number){
            return response()->json([
                'fail' => 'Invalid',
            ], 403);
        }

        if(Auth::user()->phone === $request->phone_number){
            return response()->json([
                'fail' => 'You cannot transfer money to yourself!',
            ], 403);
        }

        $user = User::where('phone' , $request->phone_number)->first();

        if(!$user) {
            return response()->json([
                'fail' => 'This phone number is not register with PayMoney!',
            ], 403);
        }

        if($user){
            $data = [
                'user_id' => $user->id,
            ];
            return response()->json([
                'success' => $data,
            ], 201);
        }


    }

    public function transferTo(Request $request)
    {
        $encodedData = $request->query('data');

        $decodedJson = base64_decode($encodedData);
        // Step 3: Convert the JSON string to a PHP array or object
        $data = json_decode($decodedJson, true); // 'true' converts it to an associative array, otherwise an object

        $userId = $data['user_id'];

        $to_user = User::findOrFail($userId);
        // auth user info wallet
        $from_user = Auth::user('web');

        $wallet = Wallet::where('user_id' ,$from_user->id)->first();

        return view('frontend.transfer.transfer' ,  compact(['from_user' , 'wallet' , 'to_user']));
    }

    public function transfer(StoreTransactionRequest $request)
    {
        $validatedData = $request->validated();

        $to_user = User::findOrFail($request->to_user);
        // auth user info wallet
        $from_user = Auth::user('web');

        $wallet = Wallet::where('user_id' ,$from_user->id)->first();

        return view('frontend.transfer.comfirm' ,  compact(['from_user' , 'wallet' , 'to_user' , 'validatedData']));

    }

    public function comfirm(Request $request)
    {
        $to_user = $request->to_user;

        $to_wallet = Wallet::where('user_id' ,$to_user['id'])->first();
        // auth user info wallet
        $from_user = Auth::user('web');

        $from_wallet = Wallet::where('user_id' ,$from_user->id)->first();

        // password check & transfer money
        if (Hash::check($request->password, $from_user->password)) {

            DB::beginTransaction();
            try {
                $from_wallet->decrement('amount', $request->amount);

                $to_wallet->increment('amount', $request->amount);

                $refNumber = UUIDGenerate::refNumberGenerate();
                $to_transaction = new Transaction();
                $to_transaction->ref_no = $refNumber;
                $to_transaction->transcation_id = UUIDGenerate::transactionIdGenerate();
                $to_transaction->user_id = $to_user['id'];
                $to_transaction->type = 2;
                $to_transaction->amount = $request->amount;
                $to_transaction->note = $request->note;
                $to_transaction->source_id = $from_user->id;
                $to_transaction->save();

                $from_transaction = new Transaction();
                $from_transaction->ref_no = $refNumber;
                $from_transaction->transcation_id = UUIDGenerate::transactionIdGenerate();
                $from_transaction->user_id = $from_user['id'];
                $from_transaction->type = 1;
                $from_transaction->amount = $request->amount;
                $from_transaction->note = $request->note;
                $from_transaction->source_id = $to_user['id'];
                $from_transaction->save();
                DB::commit();
                return $to_transaction;
            }
            catch(Exception $e) {
                DB::rollback();
                return $e;
            }
        } else {
            return response()->json([
                'fail' => 'Invalid password!',
            ], 403);
        }
    }
}
