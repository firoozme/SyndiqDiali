<div>

    @if ($type=='detail' && $ID)
        @livewire('users.fees.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.fees.edit',['syndicate'=>$syndicate, 'id'=>$ID])
    @else
         @livewire('users.fees.create',['syndicate'=>$syndicate])
         <div class="card">
             <div class="card-body">
                 @livewire('users.fees.lists',['syndicate'=>$syndicate])
             </div>
         </div>
    @endif


    @section('title')
     Fee 
    @endsection

</div>
