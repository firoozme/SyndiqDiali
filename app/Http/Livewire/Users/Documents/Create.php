<?php

namespace App\Http\Livewire\Users\Documents;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Document;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    
    public $syndicate, $name, $document;

    protected $rules = [
            'name' => 'required',
            'document' => 'required|mimes:jpeg,jpg,png,pdf',
        ];

    public function mount($syndicate)
    {
        $this->syndicate = $syndicate;
    }
    public function render()
    {
        return view('livewire.users.documents.create');
    }

    public function store()
    {
        
        // Validate
        $this->validate();

        try {

            // Document
            $file = $this->document;
            $fileName = 'syndicate_' . Carbon::now()->microsecond . '.' . $file->extension();
            $path = $file->storeAs('/upload/documents/', $fileName, 'my_files');
            
            Document::create([
                'name' => $this->name,
                "url" => $fileName,
                "syndicate_id" => $this->syndicate->id,
            ]);

            // Sweet Alert
            $this->emit('sweet', [
                'title' => 'Success!',
                'text' => 'Document Created Successfully',
                'icon' => 'success',
            ]);

            $this->reset(['name', 'document']);

            // Refresh List
            $this->emitTo('users.documents.lists', 'refresh');

        } catch (\Exception $e) {

            // Alert
            $this->emit('sweet', [
                'title' => 'Error!',
                'text' => $e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
