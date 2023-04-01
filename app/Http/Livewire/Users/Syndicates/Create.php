<?php

namespace App\Http\Livewire\Users\Syndicates;

use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;
use Illuminate\Validation\Rule;

class Create extends Component
{
    public $residents;
    public $name, $arabic_name, $creation_date, $starting_date;
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
            'arabic_name' => ['required'],
            'creation_date' => ['required', 'date'],
            'starting_date' => ['required', 'date'],
        ]);

        try {
          
            Syndicate::create([
                'name' => $this->name,
                'syndicate_name_arabic' => $this->arabic_name,
                'syndicate_creation_date' => $this->creation_date,
                'syndicate_starting_date' => $this->starting_date,
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
