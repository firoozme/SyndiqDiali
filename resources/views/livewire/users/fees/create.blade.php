<div>

    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('fees', $syndicate) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Create Fee</h3>
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
                        <div class="col-md-3">
                            <label for="syndicate_item" class="block">Syndicates <span class="text-danger">*</span></label>
                            <select class="form-control @error('syndicate_item') form-control-danger @enderror" id="syndicate_item" wire:model.defer="syndicate_item" wire:change="syndicateChanged($event.target.value)">
                                <option value=""> - </option>
                                @foreach ($syndicates as $syndicate)
                                    <option value="{{ $syndicate->id }}">{{ $syndicate->name }}</option>
                                @endforeach
                            </select>
                            @error('syndicate_item') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="resident" class="block">Resident <span class="text-danger">*</span></label>
                            <i class="fas fa-spinner fa-spin mx-3" wire:target="syndicateChanged" wire:loading ></i>
                            <select class="form-control @error('resident') form-control-danger @enderror" id="resident" wire:model.defer="resident"  wire:loading.attr="disabled" wire:target="syndicateChanged">
                                <option value=""> - </option>
                                @foreach ($residents as $resident)
                                    <option value="{{ $resident->id }}">{{ $resident->name }}</option>
                                @endforeach
                            </select>
                            @error('resident') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="amount" class="block">Amount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('amount') form-control-danger @enderror" id="amount" wire:model.defer="amount" placeholder="amount">
                            @error('amount')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-3">
                            <label for="payment_method" class="block">Payment Method <span class="text-danger">*</span></label>
                            <select class="form-control @error('payment_method') form-control-danger @enderror" id="payment_method" wire:model.defer="payment_method">
                                <option value=""> - </option>
                                <option value="especes">ESPECES</option>
                                <option value="cheque">CHEQUE</option>
                                <option value="virement">VIREMENT</option>
                                <option value="versement">VERSEMENT</option>
                                <option value="lettre de change">LETTRE DE CHANGE</option>
                                <option value="remise">REMISE</option>
                            </select>
                            @error('payment_method') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <label for="code_operation" class="block">Code Operation <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('code_operation') form-control-danger @enderror" id="code_operation" wire:model.defer="code_operation" placeholder="Code Operation">
                            @error('code_operation')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="date_operation" class="block">Date Operation <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('date_operation') form-control-danger @enderror" id="date_operation" wire:model.defer="date_operation" placeholder="Date Operation">
                            @error('date_operation')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <p for="document" class="block invisible">Upload Document</p>
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