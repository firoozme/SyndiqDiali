<div>
     <!-- Breadcrumb -->
     {{ Breadcrumbs::render('fee.show', $fee->syndicate, $fee) }}
     <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Fee Details</h3>
        </div>
        <div class="card-body">
            <div class="row p-3 mb-3 border-b">
                <div class="col-md-4">
                    @if ($fee->paymentDocumentType()=='image')
                        <img src="{{ asset('upload/fees/'.$fee->payment_document ) }}" class="img-fluid img-thumbnail">
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">ID: </div>
                <div class="col-sm-12 col-md-9">{{ $fee->id }}</div>
            </div>
           <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Document: </div>
                <div class="col-sm-12 col-md-9">
            @if ($fee->paymentDocumentType()=='image' || $fee->paymentDocumentType()=='pdf')
                @if(file_exists('upload/fees/'.$fee->payment_document)) <a href="#" wire:click.prevet="download" class="btn btn-warning btn-sm"><i class="far fa-download mr-1"></i>Download</a> @else - @endif
                @else
                -
                @endif
            </div>
        </div>
           
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Resident: </div>
                <div class="col-sm-12 col-md-9"><b>{{ $fee->resident->name }}</b></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Amount: </div>
                <div class="col-sm-12 col-md-9">{{ number_format($fee->amount,2) }}</div>
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
        <a href="{{ route('user.syndicate.fees', ['syndicate_id'=>$fee->syndicate_id]) }}" class="btn btn-success"><i class="far fa-arrow-left mr-1"></i> Back</a>
        </div>
    </div>
</div>
