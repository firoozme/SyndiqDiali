<?php

namespace App\Http\Livewire\Users\Fee;

use App\Models\Fee;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class Lists extends DataTableComponent
{
    protected $model = Fee::class;

    protected $listeners = ['refresh'];
    public function rowView(): string
    {
        return 'livewire.users.fee.lists';
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('date_operation', 'desc');

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->collapseOnTablet()
                ->sortable(),
            Column::make("Resident", "resident.name")
                ->searchable()
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
                ->title(fn($row) => 'Download')
                ->location(fn($row) => '')
                ->attributes(function ($row) {
                    return [
                        'wire:click.prevent' => "download($row->id)",
                    ];
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
                        ->title(fn($row) => 'Details')
                        ->location(fn($row) => route('user.fees', ['type' => 'detail', 'id' => $row->id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-success',
                            ];
                        }),
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('user.fees', ['type' => 'edit', 'id' => $row->id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-warning',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => 'Delete')
                        ->location(fn($row) => '')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-danger',
                                'wire:click.prevent' => "delete($row->id)",
                            ];
                        }),
                ]),

        ];
    }

    public function delete($id)
    {
        $fee = Fee::findOrFail($id);
        if($fee->delete()){
            File::delete(public_path() . '/upload/fees/' . $fee->payment_document);
            $this->emit('sweet', [
                'title' => 'Success!',
                'text' => 'Fee Deleted Successfully',
                'icon' => 'success',
            ]);
        }else{
            $this->emit('sweet',[
                'title'=> 'Error!',
                'text'=> $e->getMessage(),
                'icon'=> 'error',
            ]);
        }

        

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
