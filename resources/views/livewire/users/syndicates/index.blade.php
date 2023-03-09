<div>
    @if ($type=='detail' && $ID)
    @livewire('users.syndicates.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.syndicates.edit',['id'=>$ID])
    @else
         @livewire('users.syndicates.create')
         <div class="card">
             <div class="card-body">
                 @livewire('users.syndicates.lists')
             </div>
         </div>
    @endif


    @section('title')
        Syndicates
    @endsection
</div>
