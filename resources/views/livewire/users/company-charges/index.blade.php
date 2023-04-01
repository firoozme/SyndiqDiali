<div>

    @if ($type=='detail' && $ID)
        @livewire('users.company-charges.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.company-charges.edit',['id'=>$ID])
    @else
         @livewire('users.company-charges.create')
         <div class="card">
             <div class="card-body">
                 @livewire('users.company-charges.lists')
             </div>
         </div>
    @endif


    @section('title')
        Company Charges
    @endsection
   
</div>
