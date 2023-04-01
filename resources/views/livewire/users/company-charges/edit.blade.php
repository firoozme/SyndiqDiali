<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('companyCharges.edit', $companyCharge) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Edit Company Charge</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="form-group">
                    
                    <div class="row">
                        
                        <div class="col-md-4">
                            <label for="amount" class="block">Amount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('amount') form-control-danger @enderror" id="amount" wire:model.defer="amount" placeholder="amount">
                            @error('amount')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
                    </div>
                </div>
               
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="description" class="block">Description</label>
                            <textarea rows="10" class="form-control @error('description') form-control-danger @enderror" id="description" wire:model.defer="description" placeholder="Description"></textarea>
                            @error('description')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="upload"><i class="fas fa-spinner fa-spin mx-3" wire:target="upload" wire:loading ></i> Update</button>
                <a href="{{ route('user.company.charges') }}" class="btn btn-danger"> Cancel</a>
            </form>
        </div>
    </div>

</div>