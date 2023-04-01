<?php

namespace App\Http\Livewire\Users\Contracts;

use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;
use Barryvdh\DomPDF\Facade\Pdf;

class Index extends Component
{
    
    public $syndicate, $president, $visePresident;
    public function mount($syndicate_id)
    {
        $this->syndicate = Syndicate::findOrFail($syndicate_id);
        $this->president = Resident::where('syndicate_id', $syndicate_id)->where('role','president')->first();
        $this->visePresident = Resident::where('syndicate_id', $syndicate_id)->where('role','vise_president')->first();
       
    }
    public function render()
    {
        
        return view('livewire.users.contracts.index')->extends('layouts.user.app')->section('content');
    }

    public function pdf($syndicate_id)
    {
        $this->syndicate = Syndicate::findOrFail($syndicate_id);
        $this->president = Resident::where('syndicate_id', $syndicate_id)->where('role','president')->first();
        $this->visePresident = Resident::where('syndicate_id', $syndicate_id)->where('role','vise_president')->first();
        $data = [
            'syndicate' => $this->syndicate,
            'president' => $this->president,
            'visePresident' => $this->visePresident,
        ];
        $pdf = Pdf::loadView('livewire.users.contracts.index', $data); 


        return $pdf->download('contract'.time().'.pdf');
        

        
    }

 
}
