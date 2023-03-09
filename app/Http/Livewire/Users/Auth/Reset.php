<?php

namespace App\Http\Livewire\Users\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class Reset extends Component
{
    public $token, $email, $password, $password_confirmation;
    

    public function mount($token)
    {
        $this->token = $token;
        // dd($token);
    }
    public function render()
    {
        return view('livewire.users.auth.reset')->extends('layouts.auth.app')->section('content');
    }

    public function resetPassword()
    {
         // Validate
         $this->validate([
            'email' => 'required|email',
            'password' => 'required|same:password_confirmation',
            'password_confirmation' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')
        ->where([
          'email' => $this->email, 
          'token' => $this->token
        ])->latest()->first();
        if(!$updatePassword){

            Session::flash('error', 'Email is incorrect');
            $this->emit('notify',[
                'message' => 'Email is incorrect',
                'type' => 'danger'
            ]);
        }else{

            $user = User::where('email', $this->email)
                        ->update(['password' => Hash::make($this->password)]);
    
            DB::table('password_resets')->where(['email'=> $this->email])->delete();
    
            Session::flash('success', 'Your password has been changed!');
            return redirect()->route('user.login');
        }

    }
}

