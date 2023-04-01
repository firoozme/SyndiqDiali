<?php

namespace App\Http\Livewire\Users\Cashes;

use App\Models\Cash;
use Livewire\Component;
use App\Models\Syndicate;

class Edit extends Component
{
    public $syndicates;
    public $cash, $syndicate, $amount, $code_operation, $date_operation, $description;
    public function mount($id)
    {
        $this->syndicates = Syndicate::all();
        $this->cash = Cash::findOrFail($id);
        $this->syndicate = $this->cash->syndicate_id;
        $this->amount = $this->cash->amount;
        $this->code_operation = $this->cash->code_operation;
        $this->date_operation = $this->cash->date_operation;
        $this->description = $this->cash->description;

    }

    public function render()
    {
        return view('livewire.users.cashes.edit');
    }

    public function update()
    {
         // Validate
        $ValidatedCash = $this->validate([
            'syndicate' => 'required',
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required',
            'description' => 'required',
        ]);
        try {
           
            $this->cash->update([
                'syndicate_id' => $this->syndicate,
                'amount' => $this->amount,
                'code_operation' => $this->code_operation,
                'date_operation' => $this->date_operation,
                'description' => $this->description,
            ]);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Cash Updated Successfully',
                'icon'=> 'success',
            ]);
            return redirect()->route('user.cashes');
        } catch (\Exception $e) {
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
