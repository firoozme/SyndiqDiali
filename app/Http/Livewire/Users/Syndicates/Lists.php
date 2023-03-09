<?php

namespace App\Http\Livewire\Users\Syndicates;

use Livewire\Component;
use App\Models\Syndicate;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class Lists extends DataTableComponent
{
    protected $model = Syndicate::class;

    protected $listeners = ['refresh'];
    public function rowView(): string
    {
        return 'livewire.users.syndicates.list';
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
                ->sortable()
                ->collapseOnTablet()
                ->setSortingPillTitle('Sort')
                ->setSortingPillDirections('0-9', '9-0'),
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Create at", "created_at")
                ->searchable()
                ->sortable(),
           
            ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Deteils') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => 'Details')
                        ->location(fn($row) => route('user.syndicates', ['type'=>'detail', 'id'=>$row->id]))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-success',
                            ];
                        }),
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('user.syndicates', ['type'=>'edit', 'id'=>$row->id]))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-warning',
                            ];
                        }),
                    LinkColumn::make('Delete')
                        ->title(fn($row) => 'Delete')
                        ->location(fn($row) => '')
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-danger',
                                'wire:click.prevent' => "delete($row->id)"
                            ];
                        }),
                ])->collapseOnTablet(),
            
            
        
        ];
    }

  

    
    public function delete($id)
    {
        
            $syndicate = Syndicate::findOrFail($id);
            $syndicate->delete();
            $this->emit('sweet',[
                'title'=> 'Success!',
                'text'=> 'Syndicate Deleted Successfully',
                'icon'=> 'success',
            ]);
            $this->emit('refresh');

        
    }

    public function refresh()
    {
        $this->emit('refresh');
    }
    
}
