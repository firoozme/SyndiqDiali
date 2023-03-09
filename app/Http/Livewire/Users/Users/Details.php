<?php

namespace App\Http\Livewire\Users\Users;

use App\Models\User;
use Livewire\Component;

class Details extends Component
{
    public $user;
    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.users.details');
    }
}
