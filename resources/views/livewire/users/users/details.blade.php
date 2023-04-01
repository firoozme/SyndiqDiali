<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('user.show', $user) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>User Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">ID: </div>
                <div class="col-sm-12 col-md-9">{{ $user->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Username: </div>
                <div class="col-sm-12 col-md-9">{{ $user->username }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Status: </div>
                <div class="col-sm-12 col-md-9">{{ $user->status }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Email: </div>
                <div class="col-sm-12 col-md-9">{{ $user->email }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Phone: </div>
                <div class="col-sm-12 col-md-9">{{ $user->phone }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Create at: </div>
                <div class="col-sm-12 col-md-9">{{ $user->created_at }}</div>
            </div>
            <a href="{{ route('user.users') }}" class="btn btn-success"><i class="far fa-arrow-left mr-1"></i> Back</a>
        </div>
    </div>
</div>