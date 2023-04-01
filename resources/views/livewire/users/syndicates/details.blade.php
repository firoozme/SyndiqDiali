<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('syndicate.show', $syndicate) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Syndicate Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">ID: </div>
                <div class="col-sm-12 col-md-9">{{ $syndicate->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Name: </div>
                <div class="col-sm-12 col-md-9">{{ $syndicate->name }}</div>
            </div>
           
            <a href="{{ route('user.syndicates') }}" class="btn btn-success"><i class="far fa-arrow-left mr-1"></i> Back</a>
        </div>
    </div>
</div>