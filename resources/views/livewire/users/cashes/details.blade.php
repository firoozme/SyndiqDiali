<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('Cashes.show', $cash) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Cash Details</h3>
        </div>
        <div class="card-body">
            
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">ID: </div>
                <div class="col-sm-12 col-md-9">{{ $cash->id }}</div>
            </div>
           
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Syndicate: </div>
                <div class="col-sm-12 col-md-9"><b>{{ $cash->syndicate->name }}</b></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Amount: </div>
                <div class="col-sm-12 col-md-9">{{ number_format($cash->amount,2) }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Code Operation: </div>
                <div class="col-sm-12 col-md-9">{{ $cash->code_operation }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Date Operation: </div>
                <div class="col-sm-12 col-md-9">{{ $cash->date_operation }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Description: </div>
                <div class="col-sm-12 col-md-9">{{ $cash->description }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Create at: </div>
                <div class="col-sm-12 col-md-9">{{ $cash->created_at }}</div>
            </div>
            <a href="{{ route('user.cashes') }}" class="btn btn-success"><i class="far fa-arrow-left mr-1"></i> Back</a>
        </div>
    </div>
</div>