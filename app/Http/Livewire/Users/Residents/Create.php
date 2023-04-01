<?php

namespace App\Http\Livewire\Users\Residents;

use Livewire\Component;
use App\Models\Resident;

class Create extends Component
{
    public $syndicate, $name, $cin, $phone, $address;
    public $role = 'resident';
    public function mount($syndicate)
    {
        $this->syndicate = $syndicate;
    }
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
            'role' => 'required',
        ]);

        try {
          
            $ValidatedResident['syndicate_id'] = $this->syndicate->id;

            if($this->role != 'resident'){
                
                // Check if this role is already exist?
                if(Resident::where('syndicate_id', $this->syndicate->id)->where('role', $this->role)->count()){
                    $this->setRoleDefault($this->role);
                }
            }
            Resident::create($ValidatedResident);

             // Sweet Alert
             $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Resident Created Successfully',
                'icon'=> 'success',
            ]);

            // Reset Form
            $this->reset(['name', 'cin', 'phone', 'address', 'role']);

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

    public function setRoleDefault($role)
    {
        Resident::where('syndicate_id', $this->syndicate->id)->where('role', $role)->update([
            'role' => 'resident'
        ]);
    }
}
