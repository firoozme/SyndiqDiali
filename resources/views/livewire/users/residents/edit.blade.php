<div>
    <div class="card">
        <div class="card-header">
            <h3>Edit Resident</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name" class="block">Name *</label>
                            <input type="text" class="form-control @error('name') form-control-danger @enderror" id="name" wire:model.defer="name" placeholder="name">
                            @error('name') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="cin" class="block">Cin *</label>
                            <input type="text" class="form-control @error('cin') form-control-danger @enderror" id="cin" wire:model.defer="cin" placeholder="cin">
                            @error('cin') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="phone" class="block">Phone *</label>
                            <input type="text" class="form-control @error('phone') form-control-danger @enderror" id="phone"  wire:model.defer="phone" placeholder="phone">
                            @error('phone') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <label for="address" class="block">Address *</label>
                            <textarea class="form-control @error('address') form-control-danger @enderror" rows="10" id="address"  wire:model.defer="address" placeholder="address"></textarea>
                            @error('address') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
               
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="store"><i class="fas fa-spinner fa-spin mx-3" wire:target="update" wire:loading ></i> Update</button>
                <a href="{{ route('user.residents') }}" class="btn btn-danger"> Cancel</a>
            </form>
        </div>
    </div>


    @section('title')
        Edit Resident
    @endsection
</div>