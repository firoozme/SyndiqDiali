<?php

namespace App\Http\Livewire\Users\Fees;

use App\Models\Fee;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Details extends Component
{
    public $fee;
    public function mount($id)
    {
        $this->fee = Fee::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.fees.details');
    }

    public function download()
    {
        return Storage::disk('my_files')->download('upload/fees/'.$this->fee->payment_document);
    }
}
