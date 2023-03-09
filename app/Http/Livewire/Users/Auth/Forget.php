<?php

namespace App\Http\Livewire\Users\Auth;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Session;

class Forget extends Component
{
    public $email;
    
    public function render()
    {
        return view('livewire.users.auth.forget')->extends('layouts.auth.app')->section('content');
    }

    public function forget()
    {
        // Validate
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        
        $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $this->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('email.forgetPassword', ['token' => $token], function($message){
              $message->to($this->email);
              $message->subject('Reset Password');
          });
  
          Session::flash('success','We have e-mailed your password reset link!');
          return redirect()->route('user.login');
    }
}
