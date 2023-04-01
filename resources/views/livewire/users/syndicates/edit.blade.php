<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('syndicate.edit', $syndicate) }}
    <!-- Breadcrumb -->
    <div class="card">
    <div class="card">
        <div class="card-header">
            <h3>Edit Syndicate</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update">
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
                            <label for="arabic_name" class="block">Arabic Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('arabic_name') form-control-danger @enderror text-right" id="arabic_name" wire:model.defer="arabic_name" placeholder="arabic_name">
                            @error('arabic_name') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                       
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="creation_date" class="block">Creation Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('creation_date') form-control-danger @enderror" id="creation_date" wire:model.defer="creation_date" placeholder="Creation Date">
                            @error('creation_date')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="starting_date" class="block">Starting Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('starting_date') form-control-danger @enderror" id="starting_date" wire:model.defer="starting_date" placeholder="Starting Date">
                            @error('starting_date')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                       
                    </div>
                </div>
                
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="update"><i class="fas fa-spinner fa-spin mx-3" wire:target="update" wire:loading ></i> Update</button>
                <a href="{{ route('user.syndicates') }}" class="btn btn-danger"> Cancel</a>
            </form>
        </div>
    </div>
</div>