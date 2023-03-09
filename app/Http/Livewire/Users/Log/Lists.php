<?php

namespace App\Http\Livewire\Users\Log;

use Livewire\Component;
use App\Models\HistoryLog;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class Lists extends DataTableComponent
{
    protected $model = HistoryLog::class;

    public function rowView(): string
    {
        return 'livewire.users.logs.lists';
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
                ->sortable(),
            Column::make("Username", "username")
                ->searchable()
                ->sortable(),
            Column::make("Action Type", "action_type")
                ->searchable()
                ->sortable(),
            Column::make("Table Name", "table_name")
                ->searchable()
                ->sortable(),
            Column::make("Description", "description")
                ->searchable()
                ->sortable(),
            Column::make("Action Date", "created_at")
                ->searchable()
                ->sortable(),
        ];
    }

}
