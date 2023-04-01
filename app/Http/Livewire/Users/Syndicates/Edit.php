<?php

namespace App\Http\Livewire\Users\Syndicates;

use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public $residents;
    public $syndicate, $name, $arabic_name, $creation_date, $starting_date;
    public function mount($id)
    {
        $this->syndicate = Syndicate::findOrFail($id);
        $this->name = $this->syndicate->name;
        $this->arabic_name = $this->syndicate->syndicate_name_arabic;
        $this->creation_date = $this->syndicate->syndicate_creation_date;
        $this->starting_date = $this->syndicate->syndicate_starting_date;
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
            'arabic_name' => ['required'],
            'creation_date' => ['required', 'date'],
            'starting_date' => ['required', 'date'],
        ]);

        
        try {
            //code...
            $this->syndicate->update([
                'name'=>$this->name,
                'syndicate_name_arabic' => $this->arabic_name,
                'syndicate_creation_date' => $this->creation_date,
                'syndicate_starting_date' => $this->starting_date,
                
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
