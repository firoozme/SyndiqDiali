<?php

namespace App\Http\Livewire\Users\Cashes;

use App\Models\Cash;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class Lists extends DataTableComponent
{
    protected $model = Cash::class;

    protected $listeners = ['refresh'];
    public function rowView(): string
    {
        return 'livewire.users.cashes.lists';
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('id', 'desc');

    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->collapseOnTablet()
                ->sortable(),
            Column::make("Syndicate", "syndicate.name")
                ->searchable()
                ->sortable(),
            Column::make("Amount", "amount")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("Code Operation", "code_operation")
                ->collapseOnTablet()
                ->searchable(),
            
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
                        ->location(fn($row) => route('user.cashes', ['type' => 'detail', 'id' => $row->id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-success far fa-eye',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-original-title' => 'Detail',
                            ];
                        }),
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('user.cashes', ['type' => 'edit', 'id' => $row->id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-warning far fa-pencil',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-original-title' => 'Edit',

                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => '')
                        ->location(fn($row) => '')
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-danger far fa-trash',
                                'wire:click.prevent' => "delete($row->id)",
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-original-title' => 'Delete',
                            ];
                        }),
                ]),

        ];
    }

    public function delete($id)
    {
        $cash = Cash::findOrFail($id);
        try{
            $cash->delete();
                $this->emit('sweet', [
                    'title' => 'Success!',
                    'text' => 'Cash Deleted Successfully',
                    'icon' => 'success',
                ]);
        }catch(\Exception $e){
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


}