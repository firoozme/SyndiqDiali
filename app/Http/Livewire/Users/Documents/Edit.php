<?php

namespace App\Http\Livewire\Users\Documents;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Document;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class Edit extends Component
{
    use WithFileUploads;
    public $doc,$document, $name;
   
    public function mount($id)
    {
        $this->doc = Document::findOrFail($id);
        $this->name = $this->doc->name;


    }
    public function render()
    {
        return view('livewire.users.documents.edit');
    }
    public function update()
    {
         // Validate
        $ValidatedDocument = $this->validate([
            'name' => 'required',
            'document' => 'nullable|mimes:jpeg,jpg,png,pdf',
        ]);
        try {
            $fileName = $this->doc->url;
            if ($this->document) {
                $file = $this->document;
                File::delete(public_path() . '/upload/documents/' . $fileName);
                $fileName = 'syndicate_' . Carbon::now()->microsecond . '.' . $file->extension();
                $path = $file->storeAs('/upload/documents/', $fileName, 'my_files');
            }
            $this->doc->update([
                'name' => $this->name,
                'url' => $fileName,
            ]);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Document Updated Successfully',
                'icon'=> 'success',
            ]);
            return redirect()->route('user.syndicate.documents',['syndicate_id'=>$this->doc->syndicate_id]);
        } catch (\Exception $e) {
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
