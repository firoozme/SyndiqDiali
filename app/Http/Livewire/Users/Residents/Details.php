<?php

namespace App\Http\Livewire\Users\Residents;

use Livewire\Component;
use App\Models\Resident;

class Details extends Component
{
    public $resident;
    public function mount($id)
    {
        $this->resident = Resident::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.residents.details');
    }
}
