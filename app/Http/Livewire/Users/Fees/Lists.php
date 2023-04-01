<?php

namespace App\Http\Livewire\Users\Fees;

use App\Models\Fee;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class Lists extends DataTableComponent
{

    protected $listeners = ['refresh'];

    public $syndicate;
    
    public function mount($syndicate)
    {
       $this->syndicate = $syndicate->id;
        
    }
    public function builder(): Builder
        {
            
            return Fee::where('syndicate_id',$this->syndicate); // Select some things
        }
    public function rowView(): string
    {
        return 'livewire.users.fees.lists';
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->collapseOnTablet()
                ->sortable(),

            Column::make("Amount", "amount")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("Code Operation", "code_operation")
                ->collapseOnTablet()
                ->searchable(),
                Column::make("Payment Method", "payment_method")
                ->collapseOnTablet()
                ->searchable(),

            LinkColumn::make('Document')
                ->title(fn($row) => '')
                ->location(fn($row) => '')
                ->attributes(function ($row) {
                    $currentfee = Fee::findOrFail($row->id);
                    if($currentfee->payment_document){
                        return [
                            'wire:click.prevent' => "download($row->id)",
                            'class' => 'far fa-link',
                        ];
                    }else{
                        return [];
                    }
                })
                ->collapseOnTablet(),
            Column::make("Date Operation", "date_operation")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->collapseOnTablet()
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Details') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('user.syndicate.fees', ['syndicate_id'=>$this->syndicate,'type' => 'detail', 'id' => $row->id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-success far fa-eye',
                            ];
                        }),
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('user.syndicate.fees', ['syndicate_id'=>$this->syndicate,'type' => 'edit', 'id' => $row->id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-warning far fa-pencil',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => '')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-danger far fa-trash',
                                'wire:click.prevent' => "delete($row->id)",
                            ];
                        }),
                ]),

        ];
            

    }

    public function delete($id)
    {
        $fee = Fee::findOrFail($id);
        try{
            $fee->delete();
            File::delete(public_path() . '/upload/fees/' . $fee->payment_document);
            $this->emit('sweet', [
                'title' => 'Success!',
                'text' => 'Fee Deleted Successfully',
                'icon' => 'success',
            ]);
        }catch(\Exception $e){

            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }
       
        $this->emit('refresh');

    }

    public function refresh()
    {
        $this->emit('refresh');
    }

    public function download($id)
    {
        $fee = Fee::findOrFail($id);
        return Storage::disk('my_files')->download('upload/fees/'.$fee->payment_document);
    }


}
