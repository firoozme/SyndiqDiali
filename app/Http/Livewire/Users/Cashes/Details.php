<?php

namespace App\Http\Livewire\Users\Cashes;

use App\Models\Cash;
use Livewire\Component;

class Details extends Component
{
    public $cash;
    public function mount($id)
    {
        $this->cash = Cash::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.cashes.details');
    }
}
