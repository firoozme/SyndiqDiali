<?php

namespace App\Http\Livewire\Users\Documents;

use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class Details extends Component
{
    public $document;
    public function mount($id)
    {
        $this->document = Document::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.users.documents.details');
    }
    public function download()
    {
        return Storage::disk('my_files')->download('upload/documents/'.$this->document->url);
    }
}
