<div>
    <!-- Breadcrumb -->
    {{ Breadcrumbs::render('user.edit', $user) }}
    <!-- Breadcrumb -->
    <div class="card">
        <div class="card-header">
            <h3>Edit User</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="username" class="block">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('username') form-control-danger @enderror" id="username" wire:model.defer="username" placeholder="Username">
                            @error('username') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="password" class="block">Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('password') form-control-danger @enderror" id="password" wire:model.defer="password" placeholder="Password">
                            @error('password') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="phone" class="block">Phone</label>
                            <input type="text" class="form-control @error('phone') form-control-danger @enderror" id="phone"  wire:model.defer="phone" placeholder="Phone">
                            @error('phone') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="email" class="block">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('email') form-control-danger @enderror" id="email"  wire:model.defer="email" placeholder="Email">
                            @error('email') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="block">Status <span class="text-danger">*</span></label>
                            <select name="select" @if(auth()->user()->id == $user->id) class="form-control" disabled @else class="form-control @error('status') form-control-danger @enderror" id="status"  wire:model.defer="status" @endif>
                                
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
               
                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="store"><i class="fas fa-spinner fa-spin mx-3" wire:target="update" wire:loading ></i> Update</button>
                <a href="{{ route('user.users') }}" class="btn btn-danger"> Cancel</a>
            </form>
        </div>
    </div>


    @section('title')
        Edit User
    @endsection
</div>