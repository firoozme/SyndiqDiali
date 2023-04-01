<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('Charges.show', $charge) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Charge Details</h3>
        </div>
        <div class="card-body">
            
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">ID: </div>
                <div class="col-sm-12 col-md-9">{{ $charge->id }}</div>
            </div>
           
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Syndicate: </div>
                <div class="col-sm-12 col-md-9"><b>{{ $charge->syndicate->name }}</b></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Amount: </div>
                <div class="col-sm-12 col-md-9">{{ number_format($charge->amount,2) }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Code Operation: </div>
                <div class="col-sm-12 col-md-9">{{ $charge->code_operation }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Date Operation: </div>
                <div class="col-sm-12 col-md-9">{{ $charge->date_operation }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Description: </div>
                <div class="col-sm-12 col-md-9">{{ $charge->description }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Create at: </div>
                <div class="col-sm-12 col-md-9">{{ $charge->created_at }}</div>
            </div>
            <a href="{{ route('user.charges') }}" class="btn btn-success"><i class="far fa-arrow-left mr-1"></i> Back</a>
        </div>
    </div>
</div>