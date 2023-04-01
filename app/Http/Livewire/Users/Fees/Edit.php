<?php

namespace App\Http\Livewire\Users\Fees;

use Carbon\Carbon;
use App\Models\Fee;
use Livewire\Component;
use App\Models\Resident;
use App\Models\Syndicate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class Edit extends Component
{
    use WithFileUploads;
    public $syndicates, $residents;
    public $syndicate_item, $fee, $resident, $amount, $payment_method, $code_operation, $date_operation, $document, $new_document;
   
    public function mount($id)
    {
        
        $this->syndicates = Syndicate::all();
        $this->fee = Fee::findOrFail($id);
        $this->syndicate_item = $this->fee->syndicate_id;
        $this->residents = Resident::where('syndicate_id',$this->syndicate_item )->get();
        $this->resident = $this->fee->resident_id;
        $this->amount = $this->fee->amount;
        $this->payment_method = $this->fee->payment_method;
        $this->code_operation = $this->fee->code_operation;
        $this->date_operation = $this->fee->date_operation;

    }

    public function syndicateChanged($selected_syndicate)
    {
        $this->residents = Resident::where('syndicate_id', $selected_syndicate)->get();
    }
    public function update()
    {
         // Validate
        $ValidatedFee = $this->validate([
            'syndicate_item' => 'required',
            'resident' => 'required',
            'amount' => 'required|numeric',
            'code_operation' => 'required',
            'date_operation' => 'required',
            'payment_method' => 'nullable',
            'new_document' => 'nullable|mimes:jpeg,jpg,png,pdf',
        ]);
        try {
            $fileName = $this->fee->payment_document;
            if ($this->document) {
                $file = $this->document;
                File::delete(public_path() . '/upload/fees/' . $fileName);
                $fileName = 'fee_' . Carbon::now()->microsecond . '.' . $file->extension();
                $path = $file->storeAs('/upload/fees/', $fileName, 'my_files');
            }
            $this->fee->update([
                'syndicate_id' => $this->syndicate_item,
                'resident_id' => $this->resident,
                'amount' => $this->amount,
                'code_operation' => $this->code_operation,
                'date_operation' => $this->date_operation,
                'payment_method' => $this->payment_method,
                'payment_document' => $fileName,
            ]);
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Fee Updated Successfully',
                'icon'=> 'success',
            ]);
            return redirect()->route('user.syndicate.fees',['syndicate_id'=>$this->fee->syndicate_id]);
        } catch (\Exception $e) {
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
    }
}
