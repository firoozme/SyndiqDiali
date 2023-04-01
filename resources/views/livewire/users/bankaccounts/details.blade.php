<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('bankAccount.show', $account) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Bank Account Details</h3>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">ID: </div>
                <div class="col-sm-12 col-md-9">{{ $account->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Name: </div>
                <div class="col-sm-12 col-md-9">{{ $account->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">IBAN: </div>
                <div class="col-sm-12 col-md-9">{{ $account->iban }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">RIB: </div>
                <div class="col-sm-12 col-md-9">{{ $account->rib }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">BIC: </div>
                <div class="col-sm-12 col-md-9">{{ $account->bic }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Syndicate: </div>
                <div class="col-sm-12 col-md-9">{{ $account->syndicate->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Create at: </div>
                <div class="col-sm-12 col-md-9">{{ $account->created_at }}</div>
            </div>
            <a href="{{ route('user.accounts') }}" class="btn btn-success"><i class="far fa-arrow-left mr-1"></i> Back</a>
        </div>
    </div>
</div>