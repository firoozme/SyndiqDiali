<?php

namespace App\Http\Livewire\Users\Charges;

use App\Models\Charge;
use Livewire\Component;
use App\Models\Syndicate;

class Edit extends Component
{
    public $syndicates;
    public $charge, $syndicate, $amount, $code_operation, $date_operation, $description;
    public function mount($id)
    {
        $this->syndicates = Syndicate::all();
        $this->charge = Charge::findOrFail($id);
        $this->syndicate = $this->charge->syndicate_id;
        $this->amount = $this->charge->amount;
        $this->code_operation = $this->charge->code_operation;
        $this->date_operation = $this->charge->date_operation;
        $this->description = $this->charge->description;

    }

    public function render()
    {
        return view('livewire.users.charges.edit');
    }

    public function update()
    {
         // Validate
        $ValidatedCharge = $this->validate([
            'syndicate' => 'required',
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required',
            'description' => 'required',
        ]);
        try {
           
            $this->charge->update([
                'syndicate_id' => $this->syndicate,
                'amount' => $this->amount,
                'code_operation' => $this->code_operation,
                'date_operation' => $this->date_operation,
                'description' => $this->description,
            ]);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Charge Updated Successfully',
                'icon'=> 'success',
            ]);
            return redirect()->route('user.charges');
        } catch (\Exception $e) {
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
