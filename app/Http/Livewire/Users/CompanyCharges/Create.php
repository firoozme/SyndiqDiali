<?php

namespace App\Http\Livewire\Users\CompanyCharges;

use Livewire\Component;
use App\Models\CompanyCharge;

class Create extends Component
{
    public $code_operation, $date_operation, $amount, $description;

    protected $rules = [
        'amount' => 'required|numeric',
        'code_operation' => 'required',
        'date_operation' => 'required',
        'description' => 'nullable',
    ];

   
    public function render()
    {
        return view('livewire.users.company-charges.create');
    }
    public function store()
    {
        
        // Validate
        $this->validate();
        try {
            CompanyCharge::create([
                'amount' => $this->amount,
                'code_operation' => $this->code_operation,
                'date_operation' => $this->date_operation,
                "description" => $this->description,
            ]);

            // Sweet Alert
            $this->emit('sweet', [
                'title' => 'Success!',
                'text' => 'Company Charge Created Successfully',
                'icon' => 'success',
            ]);

            $this->reset(['amount', 'code_operation', 'date_operation', 'description']);
            // Refresh User table
            $this->emitTo('users.company-charges.lists', 'refresh');

        } catch (\Exception $e) {

            // Sweet Alert
            $this->emit('sweet', [
                'title' => 'Error!',
                'text' => $e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
