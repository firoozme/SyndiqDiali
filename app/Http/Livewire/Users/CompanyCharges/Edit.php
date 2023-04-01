<?php

namespace App\Http\Livewire\Users\CompanyCharges;

use Livewire\Component;
use App\Models\CompanyCharge;

class Edit extends Component
{
    public $companyCharge, $amount, $code_operation, $date_operation, $description;
    public function mount($id)
    {
        $this->companyCharge = CompanyCharge::findOrFail($id);
        $this->amount = $this->companyCharge->amount;
        $this->code_operation = $this->companyCharge->code_operation;
        $this->date_operation = $this->companyCharge->date_operation;
        $this->description = $this->companyCharge->description;

    }

    public function render()
    {
        return view('livewire.users.company-charges.edit');
    }

    public function update()
    {
         // Validate
        $ValidatedCompanyCharge = $this->validate([
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required',
            'description' => 'required',
        ]);
        try {
           
            $this->companyCharge->update([
                'amount' => $this->amount,
                'code_operation' => $this->code_operation,
                'date_operation' => $this->date_operation,
                'description' => $this->description,
            ]);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Company Charge Updated Successfully',
                'icon'=> 'success',
            ]);
            return redirect()->route('user.company.charges');
        } catch (\Exception $e) {
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
