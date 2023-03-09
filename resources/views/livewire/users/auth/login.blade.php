<div>
    @section('title', 'Login Page')
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    
                        <form class="md-float-material form-material" wire:submit.prevent="login">
                            <div class="text-center">
                                <img src="{{ asset('images/auth/logo.png') }}" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Sign In</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" class="form-control @error('email') form-control-danger @enderror" wire:model="email" placeholder="Your Email Address">
                                        <span class="form-bar"></span>
                                        @error('email') 
                                        <div class="col-form-label text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password" class="form-control @error('password') form-control-danger @enderror" wire:model="password" placeholder="Password">
                                        @error('password') 
                                        <div class="col-form-label text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <label>
                                                    <input type="checkbox" value="" wire:model="remember">
                                                    <span class="cr"><i class="cr-icon fas fa-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right f-right">
                                                <a href="{{ route('user.password.forget') }}" class="text-right f-w-600"> Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" wire:loading.attr="disabled" wire:target="login" ><i class="fas fa-spinner fa-spin mx-3" wire:target="login" wire:loading ></i> Sign in </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p class="text-inverse text-left m-b-0">Thank you.</p>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="{{ asset('images/auth/Logo-small-bottom.png') }}" alt="small-logo.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
</div>
