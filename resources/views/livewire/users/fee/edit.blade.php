<div>
    <div class="card">
        <div class="card-header">
            <h3>Edit Fee</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="resident" class="block">Resident *</label>
                            <select class="form-control @error('resident') form-control-danger @enderror" id="resident" wire:model.defer="resident">
                                <option> - </option>
                                @foreach ($residents as $resident)
                                    <option value="{{ $resident->id }}">{{ $resident->name }}</option>
                                @endforeach
                            </select>
                            @error('resident') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="amount" class="block">Amount *</label>
                            <input type="text" class="form-control @error('amount') form-control-danger @enderror" id="amount" wire:model.defer="amount" placeholder="amount">
                            @error('amount')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label for="payment_method" class="block">Payment Method *</label>
                            <select class="form-control @error('payment_method') form-control-danger @enderror" id="payment_method" wire:model.defer="payment_method">
                                <option> - </option>
                                @foreach ($residents as $resident)
                                    <option value="especes">ESPECES</option>
                                    <option value="cheque">CHEQUE</option>
                                    <option value="virement">VIREMENT</option>
                                    <option value="versement">VERSEMENT</option>
                                    <option value="lettre de change">LETTRE DE CHANGE</option>
                                    <option value="remise">REMISE</option>
                                @endforeach
                            </select>
                            @error('payment_method') 
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="code_operation" class="block">Code Operation *</label>
                            <input type="text" class="form-control @error('code_operation') form-control-danger @enderror" id="code_operation" wire:model.defer="code_operation" placeholder="Code Operation">
                            @error('code_operation')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="date_operation" class="block">Date Operation *</label>
                            <input type="date" class="form-control @error('date_operation') form-control-danger @enderror" id="date_operation" wire:model.defer="date_operation" placeholder="Date Operation">
                            @error('date_operation')
                                <div class="col-form-label text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        
                    </div>
                </div>

                <button class="btn btn-primary" wire:loading.attr="disabled" wire:target="update"><i class="fas fa-spinner fa-spin mx-3" wire:target="update" wire:loading ></i> Update</button>
                <a href="{{ route('user.fees') }}" class="btn btn-danger"> Cancel</a>
            </form>
        </div>
    </div>

</div>