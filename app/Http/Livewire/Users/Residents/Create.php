<?php

namespace App\Http\Livewire\Users\Residents;

use Livewire\Component;
use App\Models\Resident;

class Create extends Component
{
    public $name, $cin, $phone, $address;
    public function render()
    {
        return view('livewire.users.residents.create');
    }

    public function store()
    {
        // Validate
        $ValidatedResident = $this->validate([
            'name' => 'required',
            'cin' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        try {
          
            Resident::create($ValidatedResident);
    
             // Sweet Alert
             $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Resident Created Successfully',
                'icon'=> 'success',
            ]);

            // Refresh User table
            $this->emitTo('users.residents.lists', 'refresh');

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
