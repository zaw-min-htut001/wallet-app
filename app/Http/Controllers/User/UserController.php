<?php

namespace App\Http\Controllers\User;

use DataTables;
use App\Models\User;
use App\Models\Wallet;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Helpers\UUIDGenerate;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateAdminUser;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();

            return Datatables::of($data)
                    ->addColumn('user_agent', function ($each) {
                        if($each->user_agent){
                            $agent = new Agent();
                            $agent->setUserAgent($each->user_agent);
                            $device = $agent->device();
                            $platform = $agent->platform();
                            $browser = $agent->browser();

                            return '<div class="flex justify-center">' . "$device" . " /" . "$platform" . " /" . "$browser".'</div>';
                        }
                    })
                    ->addColumn('Actions', function ($each) {
                        $edit_icon = '<a href="'. route('users.edit' , $each->id ) .'" class="text-amber-500 bg-amber-100 p-1 rounded-lg me-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg></a>';
                        $delete_icon= '<a id="deleteItem" data-id="'.$each->id.'" class="cursor-pointer text-red-700 bg-amber-100 p-1 rounded-lg me-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg></a>';

                        return '<div class="flex justify-center">' . "$edit_icon" . "$delete_icon" . '</div>';
                    })
                    ->rawColumns(['Actions', 'user_agent'])
                    ->make(true);
        }

        return view('users.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();

            $adminUser = User::create($validatedData);

            $adminUser->password = Hash::make($request->password);

            Wallet::firstOrCreate(
                [
                    'user_id' =>  $adminUser->id
                ],
                [
                    'account_number' => UUIDGenerate::accountNumberGenerate() ,
                    'amount' => '0' ,
                ]
            );
            DB::commit();
            return redirect()->route('users.index')->with('created', 'Successfully Created!');
        }
        catch(Exception $e) {
            DB::rollback();
            return $e;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();

            $user = User::findOrFail($id);

            $user->update($validatedData);

            Wallet::firstOrCreate(
                [
                    'user_id' =>  $user->id
                ],
                [
                    'account_number' => UUIDGenerate::accountNumberGenerate() ,
                    'amount' => '0' ,
                ]
            );
            DB::commit();
            return redirect()->route('users.index')->with('updated', 'Successfully Updated!');
        }
        catch(Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = User::findOrFail($id)->delete();

        if($deleted){
            $response['success'] = 1;
        }
        return response()->json($response);
    }
}
