<?php

namespace App\Http\Livewire\Users\Documents;

use Livewire\Component;
use App\Models\Syndicate;

class Index extends Component
{
    public $type;
    public $ID;
    public $syndicate, $syndicate_id;
    public function mount($syndicate_id, $type='create', $id=null)
    {
            $this->type= $type;
            $this->ID= $id;
            $this->syndicate_id= $syndicate_id;
            $this->syndicate = Syndicate::findOrFail($this->syndicate_id);
    }
    public function render()
    {
        return view('livewire.users.documents.index')->extends('layouts.user.app')->section('content');
    }
}
