<?php

namespace App\Http\Livewire\Users\Log;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.users.log.index')->extends('layouts.user.app')->section('content');
    }
}
