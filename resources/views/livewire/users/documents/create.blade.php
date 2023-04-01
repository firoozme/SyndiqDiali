<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('documents', $syndicate) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Create Document for <b>{{ $syndicate->name }}</b></h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="form-group">
                    <div class="row p-3 mb-3 border-b">
                        <div class="col-md-4 offset-md-4">
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
                            <label for="document" class="block invisible p-0">Upload Document</label>
                            <button type="button" class="btn btn-success btn-sm block btn-block" onclick="$('#document').click()" wire:loading.attr="disabled" wire:target="document"><i class="fas fa-spinner fa-spin mx-3" wire:target="document" wire:loading ></i>Upload Document</button>
                            <input type="file" class="d-none @error('document') form-control-danger @enderror" id="document"  wire:model="document">

                            @error('document') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="store"><i class="fas fa-spinner fa-spin mx-3" wire:target="store" wire:loading ></i> Save</button>
            </form>
        </div>
    </div>
</div>