<div>
    @section('title', 'Password Forget')
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
    
                    <form class="md-float-material form-material"  wire:submit.prevent="forget">
                        <div class="text-center">
                            <img src="{{ asset('images/auth/logo.png') }}" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left">Recover your password</h3>
                                    </div>
                                </div>
                                
                                <div class="form-group form-primary">
                                    <input type="text" wire:model="email" class="form-control @error('email') form-control-danger @enderror"  placeholder="Your Email Address">
                                    <span class="form-bar"></span>
                                    @error('email') 
                                        <div class="col-form-label text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" wire:loading.attr="disabled" wire:target="forget"><i class="fas fa-spinner fa-spin mx-3" wire:target="forget" wire:loading ></i> Send Pasword Reset Link</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Thank you.</p>
                                        <p class="text-inverse text-left">Back to <a href="{{ route('user.login') }}"><b class="f-w-600">login</b></a></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('images/auth/Logo-small-bottom.png') }}" alt="small-logo.png">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
</div>
