<?php

namespace App\Http\Livewire\Users\Fees;

use Carbon\Carbon;
use App\Models\Fee;
use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $syndicates, $residents;
    public $syndicate, $syndicate_item, $resident, $amount, $payment_method, $code_operation, $date_operation, $document;

    protected $rules = [
        'syndicate_item' => 'required',
        'resident' => 'required',
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required',
            'payment_method' => 'required',
        ];
        
    public function mount($syndicate)
    {
        $this->syndicate = $syndicate;
        $this->syndicate_item = $syndicate->id;
        $this->syndicates = Syndicate::all();
        $this->residents = Resident::where('syndicate_id', $syndicate->id)->get();
    }

    public function syndicateChanged($selected_syndicate)
    {
        $this->residents = Resident::where('syndicate_id', $selected_syndicate)->get();
    }
    public function render()
    {
        return view('livewire.users.fees.create');
    }

    public function store()
    {
        // Validate
        $this->validate();

        try {

            if ($this->document) {
                $file = $this->document;
                $fileName = 'fee_' . Carbon::now()->microsecond . '.' . $file->extension();
                $path = $file->storeAs('/upload/fees/', $fileName, 'my_files');
            }
            Fee::create([
                'syndicate_id' => $this->syndicate_item,
                'resident_id' => $this->resident,
                'amount' => $this->amount,
                'code_operation' => $this->code_operation,
                'date_operation' => $this->date_operation,
                'payment_method' => $this->payment_method,
                "payment_document" => $fileName ?? null,
            ]);

            // Sweet Alert
            $this->emit('sweet', [
                'title' => 'Success!',
                'text' => 'Fee Created Successfully',
                'icon' => 'success',
            ]);

            $this->reset(['resident', 'amount', 'payment_method', 'code_operation', 'date_operation', 'document']);
            // Refresh User table
            $this->emitTo('users.fees.lists', 'refresh');

        } catch (\Exception $e) {

            // Sweet Alert
            $this->emit('sweet', [
                'title' => 'Error!',
                'text' => $e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }
}
