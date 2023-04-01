<div>
    @if ($type=='detail' && $ID)
        @livewire('users.bankaccounts.details',['id'=>$ID])
    @elseif ($type=='edit' && $ID)
        @livewire('users.bankaccounts.edit',['id'=>$ID])
    @else
         @livewire('users.bankaccounts.create')
         <div class="card">
             <div class="card-body">
                 @livewire('users.bankaccounts.lists')
             </div>
         </div>
    @endif


    @section('title')
        Bank Accounts
    @endsection
</div>
