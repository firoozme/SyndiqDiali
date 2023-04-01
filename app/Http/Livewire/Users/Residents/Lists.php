<?php

namespace App\Http\Livewire\Users\Residents;

use App\Models\Resident;
use App\Models\Syndicate;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class Lists extends DataTableComponent
{
    // protected $model = Resident::class;

    protected $listeners = ['refresh'];

    public $syndicate;
    public function mount($syndicate)
    {
       $this->syndicate = $syndicate->id;
        
    }
    public function builder(): Builder
        {
            
            return Resident::where('syndicate_id',$this->syndicate);
        }
    public function rowView(): string
    {
        return 'livewire.users.residents.lists';
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
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Cin", "cin")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("Phone", "phone")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("Address", "address")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("Role")
            ->format(
                fn($value, $row, Column $column) => ($row->role == 'vise_president')? 'Vise President' : ucfirst($row->role)
            )
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->collapseOnTablet()
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
                        ->location(fn($row) => route('user.syndicate.residents', ['syndicate_id'=>$this->syndicate, 'type' => 'detail', 'id' => $row->id]))
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
                        ->location(fn($row) => route('user.syndicate.residents', ['syndicate_id'=>$this->syndicate, 'type' => 'edit', 'id' => $row->id]))
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

        $resident = Resident::findOrFail($id);
        $resident->delete();
        $this->emit('sweet', [
            'title' => 'Success!',
            'text' => 'Resident Deleted Successfully',
            'icon' => 'success',
        ]);
        $this->emit('refresh');

    }

    public function refresh()
    {
        $this->emit('refresh');
    }

}
