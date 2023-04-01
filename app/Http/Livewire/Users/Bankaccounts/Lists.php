<?php

namespace App\Http\Livewire\Users\Bankaccounts;

use App\Models\Resident;
use App\Models\BankAccount;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class Lists extends DataTableComponent
{
    protected $model = BankAccount::class;

    protected $listeners = ['refresh'];
    public function rowView(): string
    {
        return 'livewire.users.bankaccounts.lists';
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');

    }

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->collapseOnTablet()
                ->sortable(),
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("IBAN", "iban")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("RIB", "rib")
                ->collapseOnTablet()
                ->searchable()
                ->sortable(),
            Column::make("BIC", "bic")
                ->collapseOnTablet()
                ->searchable(),

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
                        ->location(fn($row) => route('user.accounts', ['type' => 'detail', 'id' => $row->id]))
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
                        ->location(fn($row) => route('user.accounts', ['type' => 'edit', 'id' => $row->id]))
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

        $bank_account = BankAccount::findOrFail($id);
        $bank_account->delete();
        $this->emit('sweet', [
            'title' => 'Success!',
            'text' => 'Bank Account Deleted Successfully',
            'icon' => 'success',
        ]);
        $this->emit('refresh');

    }

    public function refresh()
    {
        $this->emit('refresh');
    }

}
