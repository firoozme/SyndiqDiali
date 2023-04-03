<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use App\Traits\apiTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use apiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::paginate(10); 
            return $this->responseStatus('Get All Users', [
                'data' => UserResource::collection($users),
                'link' => UserResource::collection($users)->response()->getData()->links,
                'meta' => UserResource::collection($users)->response()->getData()->meta,
            ], 'success', 200);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required',Rule::unique('users')->whereNull('deleted_at')],
            'password' => 'required',
            'email' => ['required','email',Rule::unique('users')->whereNull('deleted_at')],
            'phone' => 'nullable',
            'status' => 'in:active,inactive',
        ]);

        if($validator->fails()){
            return $this->responseStatus('User Create Validation Error', $validator->messages(), 'error', 401);
        }
        DB::beginTransaction();
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);
         DB::commit();
        
        return $this->responseStatus('User Create Success', new UserResource($user), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user){
            return $this->responseStatus('User Not Found', '', 'error', 404);
        }
        return $this->responseStatus('User detail', new UserResource($user), 'success', 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(!$user){
            return $this->responseStatus('User Not Found', '', 'error', 404);
        }
        $validator = Validator::make($request->all(), [
            'username' => ['required', Rule::unique('users')->whereNull('deleted_at')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => 'nullable',
            'status' => 'nullable|in:active,inactive',
            'password' => 'nullable',
        ]);

        if($validator->fails()){
            return $this->responseStatus('User Update Validation Error', $validator->messages(), 'error', 401);
        }
        
        $user->update([
            'username'=>$request->username,
            'password'=> $request->password ? Hash::make($request->password) : $user->password,
            'email'=>$request->email,
            'phone'=>$request->phone ?? $user->phone,
            'status'=>$request->status ?? $user->status,
        ]);
        
        return $this->responseStatus('User Updated Successfully', new UserResource($user), 'success', 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->id == $id){
            return $this->responseStatus('You Can not Delete Yourself', '', 'Error', 404); 
        }
        $user =User::find($id);
        if(!$user){
            return $this->responseStatus('User Not Found', '', 'Error', 404); 
        }
        $user->delete();
        return $this->responseStatus('User Deleted Success', '', '',  200);
        
    }
}
