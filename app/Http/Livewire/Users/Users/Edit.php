<?php

namespace App\Http\Livewire\Users\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Edit extends Component
{
    public $user, $username, $password, $email, $phone, $role, $status;
    public function mount($id)
    {
        $this->user = User::findOrFail($id);
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone;
        $this->role = $this->user->role;
        $this->status = $this->user->status;

    }
    public function render()
    {
        return view('livewire.users.users.edit');
    }

    public function update()
    {
         // Validate
         $vaidetedUser = $this->validate([
            'username' => ['required', Rule::unique('users')->whereNull('deleted_at')->ignore($this->user->id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user->id)],
            'phone' => 'nullable',
        ]);
        
        try {
            $this->user->update([
                'username'=>$this->username,
                'password'=> $this->password ? Hash::make($this->password) : $this->user->password,
                'email'=>$this->email,
                'phone'=>$this->phone,
                'status'=>$this->status ?? $this->user->status,
            ]);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'User Updated Successfully',
                'icon'=> 'success',
            ]);
            return redirect()->route('user.users');
        } catch (\Exception $e) {
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
