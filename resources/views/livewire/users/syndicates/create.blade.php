<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('syndicates') }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Create Syndicate</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="block">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') form-control-danger @enderror" id="name" wire:model.defer="name" placeholder="name">
                            @error('name') 
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