<?php

namespace App\Http\Livewire\Users\Documents;

use Livewire\Component;
use App\Models\Document;
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
            
            return Document::where('syndicate_id',$this->syndicate); // Select some things
        }
    public function rowView(): string
    {
        return 'livewire.users.documents.lists';
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
            LinkColumn::make('Document')
            ->title(fn($row) => '')
            ->location(fn($row) => '')
            ->attributes(function ($row) {
                return [
                    'wire:click.prevent' => "download($row->id)",
                    'class' => 'far fa-link',
                ];
            })
            ->collapseOnTablet(),

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
                        ->location(fn($row) => route('user.syndicate.documents', ['syndicate_id'=>$this->syndicate, 'type' => 'detail', 'id' => $row->id]))
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
                        ->location(fn($row) => route('user.syndicate.documents', ['syndicate_id'=>$this->syndicate, 'type' => 'edit', 'id' => $row->id]))
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
        $document = Document::findOrFail($id);
        try{
            $document->delete();
            File::delete(public_path() . '/upload/documents/' . $document->url);
            $this->emit('sweet', [
                'title' => 'Success!',
                'text' => 'Document Deleted Successfully',
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
        $document = Document::findOrFail($id);
        return Storage::disk('my_files')->download('upload/documents/'.$document->url);
    }


}
