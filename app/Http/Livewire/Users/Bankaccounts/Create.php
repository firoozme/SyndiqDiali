<?php

namespace App\Http\Livewire\Users\Bankaccounts;

use Livewire\Component;
use App\Models\Syndicate;
use App\Models\BankAccount;

class Create extends Component
{
    public $syndicates;
    public $name, $iban, $rib, $bic, $syndicate;

    public function mount()
    {
        $this->syndicates = Syndicate::all();
    }
    public function render()
    {
        return view('livewire.users.bankaccounts.create');
    }
    public function store()
    {
        // Validate
        $ValidatedAccount = $this->validate([
            'name' => 'required|unique:bank_accounts,name',
            'iban' => 'required',
            'rib' => 'required',
            'bic' => 'required',
            'syndicate' => 'required',
        ]);

        try {
          
            BankAccount::create([
                'name' => $this->name,
                'iban' => $this->iban,
                'rib' => $this->rib,
                'bic' => $this->bic,
                'syndicate_id' => $this->syndicate,
            ]);
    
             // Sweet Alert
             $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Bank Account Created Successfully',
                'icon'=> 'success',
            ]);

            // Refresh User table
            $this->emitTo('users.bankaccounts.lists', 'refresh');

        } catch (\Exception $e) {

            // Sweet Alert
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}

