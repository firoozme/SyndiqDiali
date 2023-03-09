<?php

namespace App\Http\Livewire\Users\Syndicates;

use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;

class Edit extends Component
{
    public $residents;
    public $syndicate, $name, $president, $vicepresident;
    public function mount($id)
    {
        $this->residents = Resident::all();
        $this->syndicate = Syndicate::findOrFail($id);
        $this->name = $this->syndicate->name;
        $this->president = $this->syndicate->president->id;
        $this->vicepresident = $this->syndicate->vicepresident->id;
    }
    public function render()
    {
        return view('livewire.users.syndicates.edit');
    }
    public function update()
    {
         // Validate
         $validatedSyndicate = $this->validate([
            'name' => 'required',
            'president' => 'required|different:vicepresident',
            'vicepresident' => 'required',
        ]);

        
        try {
            //code...
            $this->syndicate->update([
                'name'=>$this->name,
                'president_id'=>$this->president,
                'vice_president_id'=>$this->vicepresident,
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
