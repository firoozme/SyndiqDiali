<?php

namespace App\Http\Livewire\Users\Syndicates;

use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;
use Illuminate\Validation\Rule;

class Create extends Component
{
    public $residents;
    public $name;
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
            'name' => ['required',Rule::unique('syndicates')->whereNull('deleted_at')],
        ]);

        try {
          
            Syndicate::create([
                'name' => $this->name,
            ]);
    
             // Sweet Alert
             $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Syndicate Created Successfully',
                'icon'=> 'success',
            ]);

            // Reset Form
            $this->reset('name');
            
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
