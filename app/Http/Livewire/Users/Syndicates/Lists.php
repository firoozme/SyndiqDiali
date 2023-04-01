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
            Column::make("Creation at", "syndicate_creation_date")
                ->searchable()
                ->sortable(),
            Column::make("Starting at", "syndicate_starting_date")
                ->searchable()
                ->sortable(),
           
            ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
 
                    LinkColumn::make('Fee') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('user.syndicate.fees',['syndicate_id'=>$row->id]))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-dark far fa-hand-holding-usd',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-original-title' => 'Fees',
                            ];
                        }),

                    LinkColumn::make('Document') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('user.syndicate.documents',['syndicate_id'=>$row->id]))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-info far fa-file-plus',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-original-title' => 'Documents',

                            ];
                        }),
                    LinkColumn::make('Residents') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('user.syndicate.residents',['syndicate_id'=>$row->id]))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-primary far fa-user-plus',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-original-title' => 'Residents',
                            ];
                        }),
                    LinkColumn::make('Deteils') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('user.syndicates', ['type'=>'detail', 'id'=>$row->id]))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-success far fa-eye',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-original-title' => 'Detail',
                            ];
                        }),
                    LinkColumn::make('Edit') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => '')
                        ->location(fn($row) => route('user.syndicates', ['type'=>'edit', 'id'=>$row->id]))
                        ->attributes(function($row) {
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
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-sm btn-danger far fa-trash',
                                'wire:click.prevent' => "delete($row->id)",
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'data-original-title' => 'Delete',
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
