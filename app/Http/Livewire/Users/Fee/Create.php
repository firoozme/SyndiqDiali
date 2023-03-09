<?php

namespace App\Http\Livewire\Users\Fee;

use Carbon\Carbon;
use App\Models\Fee;
use Livewire\Component;
use App\Models\Resident;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rules\File;

class Create extends Component
{
    use WithFileUploads;
    public $residents;
    public $resident, $amount, $payment_method, $code_operation, $date_operation, $document;
    public function mount()
    {
        $this->residents = Resident::all();
    }
    public function render()
    {
        return view('livewire.users.fee.create');
    }

    public function store()
    {
        // Validate
        $ValidatedFee = $this->validate([
            'resident' => 'required',
            'amount' => 'required|numeric',
            'code_operation' => 'nullable',
            'date_operation' => 'required',
            'payment_method' => 'required',
            'document' => 'required|max:5120',
        ]);

        try {
          
            if ($this->document) {
                $file = $this->document;
                $fileName = 'fee_'.Carbon::now()->microsecond . '.' . $file->extension();
                $path = $file->storeAs('/upload/fees/', $fileName, 'my_files');
            }
            Fee::create([
                'resident_id' => $this->resident,
                'amount' => $this->amount,
                'code_operation' => $this->code_operation,
                'date_operation' => $this->date_operation,
                'payment_method' => $this->payment_method,
                "payment_document" => $fileName ?? null,
            ]);
    
             // Sweet Alert
             $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Fee Created Successfully',
                'icon'=> 'success',
            ]);

            // Refresh User table
            $this->emitTo('users.fee.lists', 'refresh');

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
