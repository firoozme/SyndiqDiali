<?php

namespace App\Http\Livewire\Users\Syndicates;

use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;

class Create extends Component
{
    public $residents;
    public $name, $vicepresident, $president;
    public function mount()
    {
        $this->residents = Resident::all();
        
    }
    public function render()
    {
        return view('livewire.users.syndicates.create');
    }

    public function store()
    {
        // Validate
        $validatedSyndicate = $this->validate([
            'name' => 'required',
            'president' => 'required|different:vicepresident',
            'vicepresident' => 'required',
        ]);

        try {
          
            Syndicate::create([
                'name' => $this->name,
                'president_id' => $this->president,
                'vice_president_id' => $this->vicepresident,
            ]);
    
             // Sweet Alert
             $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Syndicate Created Successfully',
                'icon'=> 'success',
            ]);

            // Refresh User table
            $this->emitTo('users.syndicates.lists', 'refresh');

        } catch (\Exception $e) {

            // Sweet Alert
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
