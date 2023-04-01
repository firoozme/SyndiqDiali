<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('document.edit', $doc->syndicate, $doc) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Edit Document</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="form-group">
                    <div class="row p-3 mb-3 border-b text-center">
                        <div class="col-md-4 offset-md-4">
                            @if ($doc->paymentDocumentType()=='image')
                                <img src="{{ asset('upload/documents/'.$doc->url ) }}" class="img-fluid img-thumbnail">
                            @else
                                <a href="{{ asset('upload/documents/'.$doc->url ) }}"><img src="{{ asset('images/pdf.png') }}" class="img-fluid img-thumbnail"></a>
                            @endif
                            @if ($document)
                            @php
                                try{
                                    echo '<img src="'. $document->temporaryUrl().'" class="img-fluid img-thumbnail">';
                                }catch(\Exception $e){
                                    echo "<div class='alert alert-success text-center'><strong>File Uploaded successfully</strong></div>";
                                }
                            @endphp
                               
                            @endif
                        </div>
                        
                    </div>
                    <div class="row">
                       
                        <div class="col-md-9">
                            <label for="name" class="block">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') form-control-danger @enderror" id="name" wire:model.defer="name" placeholder="name">
                            @error('name')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <p for="document" class="block invisible">Upload Document</p>
                            <button type="button" class="btn btn-success btn-sm block btn-block" onclick="$('#document').click()" wire:loading.attr="disabled" wire:target="document"><i class="fas fa-spinner fa-spin mx-3" wire:target="document" wire:loading ></i>Upload Document</button>
                            <input type="file" class="d-none @error('document') form-control-danger @enderror" id="document"  wire:model="document">
                            {{-- <div class="col-form-label text-primary"><small><span class="font-weight-bold">Max:</span>: 5M</small></div> --}}

                            @error('document') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                            
                            
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="upload"><i class="fas fa-spinner fa-spin mx-3" wire:target="upload" wire:loading ></i> Update</button>
                <a href="{{ route('user.syndicate.documents',['syndicate_id'=>$doc->syndicate_id]) }}" class="btn btn-danger"> Cancel</a>
            </form>
        </div>
    </div>

</div>