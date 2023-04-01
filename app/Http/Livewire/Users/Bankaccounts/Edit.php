<?php

namespace App\Http\Livewire\Users\Bankaccounts;

use Livewire\Component;
use App\Models\Syndicate;
use App\Models\BankAccount;
use Illuminate\Validation\Rule;

class Edit extends Component
{

    public $syndicates;
    public $account, $resident, $iban, $payment_method, $code_operation, $date_operation, $document;
   
    public function mount($id)
    {
        $this->syndicates = Syndicate::all();
        $this->account = BankAccount::findOrFail($id);
        $this->name = $this->account->name;
        $this->syndicate = $this->account->syndicate_id;
        $this->iban = $this->account->iban;
        $this->rib = $this->account->rib;
        $this->bic = $this->account->bic;

    }

    public function render()
    {
        return view('livewire.users.bankaccounts.edit');
    }

    public function update()
    {
        // Validate
        $ValidatedAccount = $this->validate([
            'name' => ['required',Rule::unique('bank_accounts')->whereNull('deleted_at')->ignore($this->account)] ,
            'iban' => 'required',
            'rib' => 'required',
            'bic' => 'required',
            'syndicate' => 'required',
        ]);
        
        try {
            $this->account->update([
                'syndicate_id' => $this->syndicate,
                'name' => $this->name,
                'iban' => $this->iban,
                'rib' => $this->rib,
                'bic' => $this->bic,
            ]);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Bank Account Updated Successfully',
                'icon'=> 'success',
            ]);
            return redirect()->route('user.accounts');
        } catch (\Exception $e) {
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
