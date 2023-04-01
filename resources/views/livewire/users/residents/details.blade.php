<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('resident.show', $resident->syndicate, $resident) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Resident Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">ID: </div>
                <div class="col-sm-12 col-md-9">{{ $resident->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Name: </div>
                <div class="col-sm-12 col-md-9">{{ $resident->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Cin: </div>
                <div class="col-sm-12 col-md-9">{{ $resident->cin }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Phone: </div>
                <div class="col-sm-12 col-md-9">{{ $resident->phone }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Address: </div>
                <div class="col-sm-12 col-md-9">{{ $resident->address }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Syndicate: </div>
                <div class="col-sm-12 col-md-9">{{ $resident->syndicate->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Create at: </div>
                <div class="col-sm-12 col-md-9">{{ $resident->created_at }}</div>
            </div>
            <a href="{{ route('user.syndicate.residents',['syndicate_id'=>$resident->syndicate->id]) }}" class="btn btn-success"><i class="far fa-arrow-left mr-1"></i> Back</a>
        </div>
    </div>
</div>