<div>
    @if ($type=='detail' && $ID)
        @livewire('users.residents.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.residents.edit',['id'=>$ID])
    @else
         @livewire('users.residents.create')
         <div class="card">
             <div class="card-body">
                 @livewire('users.residents.lists')
             </div>
         </div>
    @endif


    @section('title')
        Residents
    @endsection
</div>
