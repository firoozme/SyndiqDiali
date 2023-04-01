<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('resident.edit', $resident->syndicate, $resident) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Edit Resident </h3>
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
                            <label for="phone" class="block">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('phone') form-control-danger @enderror" id="phone"  wire:model.defer="phone" placeholder="phone">
                            @error('phone') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            
                            <div class="form-radio">
                                <label for="phone" class="block p-0">Role <span class="text-danger">*</span></label>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="role" checked="checked" wire:model.defer="role"  value="resident">
                                            <i class="helper"></i>Resident
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="role" wire:model.defer="role" value="president">
                                            <i class="helper"></i>President
                                        </label>
                                    </div>
                                    <div class="radio radio-inline">
                                        <label>
                                            <input type="radio" name="role" wire:model.defer="role" value="vise_president">
                                            <i class="helper"></i>Vise President
                                        </label>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="cin" class="block">Cin <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('cin') form-control-danger @enderror" id="cin" wire:model.defer="cin" placeholder="cin">
                            @error('cin') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <label for="address" class="block">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('address') form-control-danger @enderror" rows="10" id="address"  wire:model.defer="address" placeholder="address"></textarea>
                            @error('address') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="update"><i class="fas fa-spinner fa-spin mx-3" wire:target="update" wire:loading ></i> Save</button>
                <a href="{{ route('user.syndicate.residents',['syndicate_id'=>$syndicate->id]) }}" class="btn btn-danger"> Cancel</a>
            </form>
        </div>
    </div>
</div>