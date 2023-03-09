<div>
    <div class="card">
        <div class="card-header">
            <h3>Edit Syndicate</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="block">Name *</label>
                            <input type="text" class="form-control @error('name') form-control-danger @enderror" id="name" wire:model="name" placeholder="name">
                            @error('name') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                       
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <label for="president" class="block">President *</label>
                            <select class="form-control @error('president') form-control-danger @enderror" id="president" wire:model="president"> 
                                <option >-</option>
                                @foreach ($residents as $resident)
                                    <option value="{{ $resident->id }}" >{{ $resident->name }}</option>
                                @endforeach
                            </select>
                            @error('president') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="vicepresident" class="block">Vice President *</label>
                            <select class="form-control @error('vicepresident') form-control-danger @enderror" id="vicepresident" wire:model.defer="vicepresident">
                                <option >-</option>
                                @foreach ($residents as $resident)
                                    <option value="{{ $resident->id }}">{{ $resident->name }}</option>
                                @endforeach
                            </select>
                            @error('vicepresident') 
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