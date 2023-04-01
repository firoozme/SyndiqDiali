<?php

namespace App\Http\Livewire\Users\Users;

use Livewire\Component;

class Index extends Component
{
    public $type;
    public $ID;
    public $title = 'Users';
    
    public function mount($type='create', $id=null)
    {
            $this->type= $type;
            $this->ID= $id;
    }
    public function render()
    {
        return view('livewire.users.users.index')->extends('layouts.user.app')->section('content');
    }


    
}
