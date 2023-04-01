<div>

    @if ($type=='detail' && $ID)
        @livewire('users.users.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.users.edit',['id'=>$ID])
    @else
         @livewire('users.users.create')
        <div class="card">
             <div class="card-body">
                 @livewire('users.users.lists')
             </div>
         </div>
    @endif


    @section('title')
        {{ $title }}
    @endsection
   
</div>
