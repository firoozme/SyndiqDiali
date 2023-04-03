<?php

namespace App\Http\Controllers\api\v1;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\apiTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    use apiTrait;
    
    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
           return $this->responseStatus('Login Validation Error',$validator->messages(),'error',422);
        }
        
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return $this->responseStatus('Login Validation Error','User Not Found','error',401);
        }
        
        $token = $user->createToken('my_token')->accessToken;
        return $this->responseStatus('Login Successfull',[
            'user' =>$user,
            'token' => $token
        ],'success',200);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return $this->responseStatus('Logout Successfull','','success',200);
    }

    public function forget(Request $request)
    {
        $email = $request->email;
        // Validate
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Forget Validation Error', $validator->messages(), 'error', 401);
        }
        
        $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
            try {
                Mail::send('email.forgetPassword', ['token' => $token], function($message) use ($email){
                    $message->to($email);
                    $message->subject('Reset Password');
                });
                return $this->responseStatus('Reset link was Sent','', 201);
            } catch (\Exception $e) {
                return $this->responseStatus($e->getMessage(), '', 500);
            }
  
    }
    public function reset(Request $request)
    {
        $token = $request->token; // "dHVoWGmV8Z8mPDmjNS23p9zXq4gh3usSoAOC9zzoFKpR0EHfMuzSXTctXSwzrBaI"
        $email = $request->email; // "s111"
        $password = $request->password; // "s222" 
        $password_confirmation = $request->password_confirmation; // "s333"

        // Validate
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->responseStatus('Forget Validation Error', $validator->messages(), 'error', 401);
        }
        
        $updatePassword = DB::table('password_resets')
        ->where([
          'email' => $email, 
          'token' => $token
        ])->latest()->first();
        if(!$updatePassword){
            return $this->responseStatus('Email or Token is incorrect','', 500);
        }else{

            $user = User::where('email', $email)->update(['password' => Hash::make($password)]);
            DB::table('password_resets')->where(['email'=> $email])->delete();
            return $this->responseStatus('Password was Changed','', 201);
        }

        
    }


}
