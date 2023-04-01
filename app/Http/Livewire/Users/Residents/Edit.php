<?php

namespace App\Http\Livewire\Users\Residents;

use Livewire\Component;
use App\Models\Resident;

class Edit extends Component
{
    public $syndicate, $role, $resident, $name, $cin, $phone, $address;
    public function render()
    {
        return view('livewire.users.residents.edit');
    }
    public function mount($syndicate, $id)
    {
        $this->syndicate = $syndicate;
        $this->resident = Resident::findOrFail($id);
        $this->name = $this->resident->name;
        $this->cin = $this->resident->cin;
        $this->phone = $this->resident->phone;
        $this->address = $this->resident->address;
        $this->role = $this->resident->role;

    }

    public function update()
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

            // Check if this role is already exist?
            if($this->role != 'resident'){
                if(Resident::where('syndicate_id', $this->syndicate->id)->where('role', $this->role)->count()){
                    $this->setRoleDefault($this->role);
                }
            }

            $this->resident->update($ValidatedResident);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Resident Updated Successfully',
                'icon'=> 'success',
            ]);
            return redirect()->route('user.syndicate.residents',['syndicate_id'=>$this->syndicate->id]);
        } catch (\Exception $e) {
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
