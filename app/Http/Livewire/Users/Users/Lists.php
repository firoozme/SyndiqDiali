<?php

namespace App\Http\Livewire\Users\Users;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Lists extends DataTableComponent
{
    protected $model = User::class;

    protected $listeners = ['refresh'];
    public function rowView(): string
    {
        return 'livewire.users.users.list';
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
            Column::make("Username", "username")
                ->searchable()
                ->sortable(),
            Column::make("Email", "email")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("Phone", "phone")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("Status", "status")
                ->collapseOnTablet()
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
                        ->location(fn($row) => route('user.users', ['type' => 'detail', 'id' => $row->id]))
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
                        ->location(fn($row) => route('user.users', ['type' => 'edit', 'id' => $row->id]))
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
        if (auth()->user()->id == $id) {
            $this->emit('sweet', [
                'title' => 'Error!',
                'text' => 'You Cannot Delete Yourself',
                'icon' => 'error',
            ]);
        } else {
            $user = User::findOrFail($id);
            $user->delete();
            $this->emit('sweet', [
                'title' => 'Success!',
                'text' => 'User Deleted Successfully',
                'icon' => 'success',
            ]);
            $this->emit('refresh');

        }

    }

    public function refresh()
    {
        $this->emit('refresh');
    }

}
