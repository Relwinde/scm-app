<div>
    <div class="">
        <div class="col col-login mx-auto mt-7">
            <div class="text-center">
                <a href="{{url('/')}}">
                    <img src="{{asset('build/assets/images/brand/logo-4.png')}}" class="header-brand-img" alt="logo">
                </a>
            </div>
        </div>
        <!-- CONTAINER OPEN -->
        <div class="container-login100">
            <div class="wrap-login100 p-5">
                <form class="login100-form validate-form ">
                    <div class="text-center mb-4">
                        <img src="{{asset('build/assets/images/users/10.jpg')}}" alt="lockscreen image" class="avatar avatar-xxl brround mb-2">
                        <h4>{{Auth::user()->name}}</h4>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" wire:model='password' type="password" placeholder="Mot de passe">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        
                    </div>
                    @error('password')<div class="error-message"> {{ $message }} </div>@enderror
                    <div class="container-login100-form-btn pt-2">
                        <a wire:click='unlock' href="javascript:void(0);" class="login100-form-btn btn-primary">
                            Dévérouiller
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
</div>
