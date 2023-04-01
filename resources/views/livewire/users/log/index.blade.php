<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('historyLog') }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-body">
            @livewire('users.log.lists')
        </div>
    </div>

    @section('title')
        History Logs
    @endsection
</div>
