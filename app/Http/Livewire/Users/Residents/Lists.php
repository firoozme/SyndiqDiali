<?php

namespace App\Http\Livewire\Users\Residents;

use App\Models\Resident;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Lists extends DataTableComponent
{
    protected $model = Resident::class;

    protected $listeners = ['refresh'];
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
                        ->title(fn($row) => 'Details')
                        ->location(fn($row) => route('user.residents', ['type' => 'detail', 'id' => $row->id]))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn btn-sm btn-success',
                            ];
                        }),
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('user.residents', ['type' => 'edit', 'id' => $row->id]))
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

        $user = Resident::findOrFail($id);
        $user->delete();
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
