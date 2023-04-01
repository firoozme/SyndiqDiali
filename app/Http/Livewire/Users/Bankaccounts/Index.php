<?php

namespace App\Http\Livewire\Users\Bankaccounts;

use Livewire\Component;

class Index extends Component
{
    public $type;
    public $ID;
    public function mount($type='create', $id=null)
    {
            $this->type= $type;
            $this->ID= $id;
    }
    public function render()
    {
        return view('livewire.users.bankaccounts.index')->extends('layouts.user.app')->section('content');
    }
}
