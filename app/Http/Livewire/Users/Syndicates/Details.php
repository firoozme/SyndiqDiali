<?php

namespace App\Http\Livewire\Users\Syndicates;

use Livewire\Component;
use App\Models\Syndicate;

class Details extends Component
{
    public $syndicate;
    public function mount($id)
    {
        $this->syndicate = Syndicate::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.syndicates.details');
    }
}
