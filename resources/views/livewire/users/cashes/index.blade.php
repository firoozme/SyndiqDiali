<div>

    @if ($type=='detail' && $ID)
        @livewire('users.cashes.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.cashes.edit',['id'=>$ID])
    @else
         @livewire('users.cashes.create')
         <div class="card">
             <div class="card-body">
                 @livewire('users.cashes.lists')
             </div>
         </div>
    @endif


    @section('title')
        Cashes
    @endsection
   
</div>
