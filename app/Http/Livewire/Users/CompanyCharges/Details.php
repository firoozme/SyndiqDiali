<?php

namespace App\Http\Livewire\Users\CompanyCharges;

use Livewire\Component;
use App\Models\CompanyCharge;

class Details extends Component
{
    public $companyCharge;
    public function mount($id)
    {
        $this->companyCharge = CompanyCharge::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.company-charges.details');
    }
}
