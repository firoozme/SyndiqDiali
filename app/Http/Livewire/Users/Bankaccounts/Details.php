<?php

namespace App\Http\Livewire\Users\Bankaccounts;

use Livewire\Component;
use App\Models\BankAccount;

class Details extends Component
{
    public $account;
    public function mount($id)
    {
        $this->account = BankAccount::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.bankaccounts.details');
    }
}
