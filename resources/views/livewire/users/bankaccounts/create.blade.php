<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('bankAccounts', $syndicate) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Create Bank Account</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name" class="block">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') form-control-danger @enderror" id="name" wire:model.defer="name" placeholder="name">
                            @error('name') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="syndicate" class="block">Syndicate <span class="text-danger">*</span></label>
                            <select type="text" class="form-control @error('syndicate') form-control-danger @enderror" id="syndicate" wire:model.defer="syndicate" >
                            <option>-</option>
                            @foreach ($syndicates as $syndicate)
                            <option value="{{ $syndicate->id }}">{{ $syndicate->name }}</option>

                            @endforeach
                            </select>
                            @error('syndicate') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        
                        <div class="col-md-4">
                            <label for="iban" class="block">IBAN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('iban') form-control-danger @enderror" id="iban" wire:model.defer="iban" placeholder="IBAN">
                            @error('iban') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="rib" class="block">RIB <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('rib') form-control-danger @enderror" id="rib"  wire:model.defer="rib" placeholder="RIB">
                            @error('rib') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="bic" class="block">BIC <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('bic') form-control-danger @enderror" id="bic" wire:model.defer="bic" placeholder="BIC">
                            @error('bic') 
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