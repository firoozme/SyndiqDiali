<?php

namespace App\Http\Livewire\Users\Syndicates;

use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public $residents;
    public $syndicate, $name;
    public function mount($id)
    {
        $this->syndicate = Syndicate::findOrFail($id);
        $this->name = $this->syndicate->name;
    }
    public function render()
    {
        return view('livewire.users.syndicates.edit');
    }
    public function update()
    {
         // Validate
         $validatedSyndicate = $this->validate([
            'name' => ['required', Rule::unique('syndicates')->whereNull('deleted_at')->ignore($this->syndicate->id)],
        ]);

        
        try {
            //code...
            $this->syndicate->update([
                'name'=>$this->name,
            ]);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Syndicate Updated Successfully',
                'icon'=> 'success',
            ]);

            return redirect()->route('user.syndicates');
        } catch (\Exception $e) {
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
