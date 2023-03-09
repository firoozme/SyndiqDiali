<?php

namespace App\Http\Livewire\Users\Fee;

use App\Models\Fee;
use Livewire\Component;

class Details extends Component
{
    public $fee;
    public function mount($id)
    {
        $this->fee = Fee::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.fee.details');
    }
}
