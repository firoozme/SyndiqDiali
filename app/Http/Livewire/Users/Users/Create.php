<?php

namespace App\Http\Livewire\Users\Users;

use App\Models\User;
use Livewire\Component;
use App\Models\HistoryLog;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $username, $password, $email, $phone, $role='resident';
    public $status = 'active';

    public function render()
    {
        return view('livewire.users.users.create');
    }
    public function store()
    {
        // Validate
        $validatedUser = $this->validate([
            'username' => ['required',Rule::unique('users')->whereNull('deleted_at')],
            'password' => 'required',
            'email' => ['required','email',Rule::unique('users')->whereNull('deleted_at')],
            'phone' => 'nullable',
            'status' => 'required',
        ]);

        try {
            // Encrypt the password
            $validatedUser['password']= Hash::make($this->password);
            
            // Store User 
            $newUser = User::create($validatedUser);
    
             // Sweet Alert
             $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'User Created Successfully',
                'icon'=> 'success',
            ]);

            

            // Reset Form
            $this->reset(['username', 'password', 'email', 'phone', 'status']);

            // Refresh List
            $this->emitTo('users.users.lists', 'refresh');

        } catch (\Exception $e) {

            // Sweet Alert
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
