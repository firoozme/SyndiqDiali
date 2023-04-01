<div>
    @if ($type=='detail' && $ID)
        @livewire('users.documents.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.documents.edit',['syndicate'=>$syndicate, 'id'=>$ID])
    @else
         @livewire('users.documents.create',['syndicate'=>$syndicate])
         <div class="card">
             <div class="card-body">
                <h3 class="text-center">Documents of <b>{{ $syndicate->name }}</b></h3>
                 @livewire('users.documents.lists',['syndicate'=>$syndicate])
             </div>
         </div>
    @endif


    @section('title')
    {{ $syndicate->name }} | Document 
    @endsection

</div>
