<?php

namespace App\Http\Livewire\Users\Auth;

use Livewire\Component;
use Session;

class Login extends Component
{
    public $email, $password;
    public $remember = false;

    public function render()
    {
        return view('livewire.users.auth.login')->extends('layouts.auth.app')->section('content');
    }


    public function login()
    {
        // Validate
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

      
        if (auth()->attempt(['email' => $this->email, 'password' => $this->password, 'status' => 1], $this->remember)) {

            // Flash Success Message
            Session::flash('success', 'You are successfully logged in');
            
            // Redirect
            return redirect()->route('user.dashboard');
        }else{

            // Fail Alert
            $this->emit('notify',[
                'message' => 'Email or Password is incorrect or User is inactive',
                'type' => 'danger'
            ]);
            
        }
    }
}
