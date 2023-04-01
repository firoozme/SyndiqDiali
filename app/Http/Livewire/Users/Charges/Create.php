<?php

namespace App\Http\Livewire\Users\Charges;

use App\Models\Charge;
use App\Models\Syndicate;
use Livewire\Component;

class Create extends Component
{
    public $syndicates;
    public $syndicate, $code_operation, $date_operation, $amount, $description;

    protected $rules = [
        'syndicate' => 'required',
        'amount' => 'required|numeric',
        'code_operation' => 'required',
        'date_operation' => 'required',
        'description' => 'nullable',
    ];

    public function mount()
    {
        $this->syndicates = Syndicate::all();
    }
    public function render()
    {
        return view('livewire.users.charges.create');
    }

    public function store()
    {
        // Validate
        $this->validate();
        try {
            Charge::create([
                'syndicate_id' => $this->syndicate,
                'amount' => $this->amount,
                'code_operation' => $this->code_operation,
                'date_operation' => $this->date_operation,
                "description" => $this->description,
            ]);

            // Sweet Alert
            $this->emit('sweet', [
                'title' => 'Success!',
                'text' => 'Charge Created Successfully',
                'icon' => 'success',
            ]);

            $this->reset(['syndicate', 'amount', 'code_operation', 'date_operation', 'description']);
            // Refresh User table
            $this->emitTo('users.charges.lists', 'refresh');

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
