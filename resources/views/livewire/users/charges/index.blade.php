<div>

    @if ($type=='detail' && $ID)
        @livewire('users.charges.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.charges.edit',['id'=>$ID])
    @else
         @livewire('users.charges.create')
         <div class="card">
             <div class="card-body">
                 @livewire('users.charges.lists')
             </div>
         </div>
    @endif


    @section('title')
        Charges
    @endsection
   
</div>
