<div>

    @if ($type=='detail' && $ID)
        @livewire('users.fee.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.fee.edit',['id'=>$ID])
    @else
         @livewire('users.fee.create')
         <div class="card">
             <div class="card-body">
                 @livewire('users.fee.lists')
             </div>
         </div>
    @endif


    @section('title')
        Fee
    @endsection
   
</div>
