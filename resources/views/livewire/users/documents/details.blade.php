<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('document.show', $document->syndicate, $document) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Document Details</h3>
        </div>
        <div class="card-body">
            <div class="row p-3 mb-3 border-b">
                <div class="col-md-4">
                    @if ($document->paymentDocumentType()=='image')
                        <img src="{{ asset('upload/documents/'.$document->url ) }}" class="img-fluid img-thumbnail">
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">ID: </div>
                <div class="col-sm-12 col-md-9">{{ $document->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Name: </div>
                <div class="col-sm-12 col-md-9">{{ $document->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Document: </div>
                <div class="col-sm-12 col-md-9">@if(file_exists('upload/documents/'.$document->url)) <a href="#" wire:click.prevet="download" class="btn btn-warning btn-sm"><i class="far fa-download mr-1"></i>Download</a> @else - @endif</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-3 font-weight-bold text-primary">Resident: </div>
                <div class="col-sm-12 col-md-9"><b>{{ $document->syndicate->name }}</b></div>
            </div>
           
            <a href="{{ route('user.syndicate.documents',['syndicate_id'=>$document->syndicate->id]) }}" class="btn btn-success"><i class="far fa-arrow-left mr-1"></i> Back</a>
        </div>
    </div>
</div>