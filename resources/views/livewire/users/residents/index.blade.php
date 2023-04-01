<div>
    @if ($type=='detail' && $ID)
        @livewire('users.residents.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.residents.edit',['syndicate'=>$syndicate, 'id'=>$ID])
    @else
         @livewire('users.residents.create',['syndicate'=>$syndicate])
         <div class="card">
             <div class="card-body">
                <h3 class="text-center">Residents of <b>{{ $syndicate->name }}</b></h3>
                 @livewire('users.residents.lists',['syndicate'=>$syndicate])
             </div>
         </div>
    @endif


    @section('title')
    {{ $syndicate->name }} | Residents 
    @endsection

</div>
