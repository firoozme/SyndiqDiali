<div>
    <div class="card">
        <div class="card-header">
            <h3>Fee Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">ID: </div>
                <div class="col-sm-12 col-md-9">{{ $fee->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Resident: </div>
                <div class="col-sm-12 col-md-9"><b>{{ $fee->resident->name }}</b></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Amount: </div>
                <div class="col-sm-12 col-md-9">{{ number_format($fee->amount) }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Payment Method: </div>
                <div class="col-sm-12 col-md-9">{{ $fee->payment_method }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Code Operation: </div>
                <div class="col-sm-12 col-md-9">{{ $fee->code_operation }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Date Operation: </div>
                <div class="col-sm-12 col-md-9">{{ $fee->date_operation }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Create at: </div>
                <div class="col-sm-12 col-md-9">{{ $fee->created_at }}</div>
            </div>
            <a href="{{ route('user.fees') }}" class="btn btn-success"><i class="far fa-arrow-left mr-1"></i> Back</a>
        </div>
    </div>
</div>