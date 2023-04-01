<?php

namespace App\Http\Livewire\Users\Charges;

use App\Models\Charge;
use Livewire\Component;

class Details extends Component
{
    public $charge;
    public function mount($id)
    {
        $this->charge = Charge::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.charges.details');
    }
}
