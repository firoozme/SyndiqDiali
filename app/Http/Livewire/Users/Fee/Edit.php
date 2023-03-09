<?php

namespace App\Http\Livewire\Users\Fee;

use App\Models\Fee;
use Livewire\Component;
use App\Models\Resident;

class Edit extends Component
{
    public $residents;
    public $fee, $resident, $amount, $payment_method, $code_operation, $date_operation, $document;
   
    public function mount($id)
    {
        $this->residents = Resident::all();
        $this->fee = Fee::findOrFail($id);
        $this->resident = $this->fee->resident_id;
        $this->amount = $this->fee->amount;
        $this->payment_method = $this->fee->payment_method;
        $this->code_operation = $this->fee->code_operation;
        $this->date_operation = $this->fee->date_operation;
        $this->document = $this->fee->document;

    }
    public function render()
    {
        return view('livewire.users.fee.edit');
    }

    public function update()
    {
         // Validate
        $ValidatedFee = $this->validate([
            'resident' => 'required',
            'amount' => 'required|numeric',
            'code_operation' => 'nullable',
            'date_operation' => 'required',
            'payment_method' => 'required',
        ]);
        
        try {
            $this->fee->update([
                'resident_id' => $this->resident,
                'amount' => $this->amount,
                'code_operation' => $this->code_operation,
                'date_operation' => $this->date_operation,
                'payment_method' => $this->payment_method,
            ]);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Fee Updated Successfully',
                'icon'=> 'success',
            ]);
            return redirect()->route('user.fees');
        } catch (\Exception $e) {
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
