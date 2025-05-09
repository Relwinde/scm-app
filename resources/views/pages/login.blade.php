
<div class="">
<!-- CONTAINER OPEN -->
<div class="col col-login mx-auto mt-7">
    <div class="text-center">
        <a href="#">
            <img src="{{asset('build/assets/images/brand/logo-4.png')}}" class="header-brand-img" alt="logo">
        </a>
    </div>
</div>
<div class="container-login100">
    <div class="wrap-login100 p-6">
        <form wire.submit="login" class="login100-form validate-form">
            <span class="login100-form-title">
                Connexion
            </span>
            
            @error('userName')<div class="error-message"> {{ $message }} </div>@enderror
            @error('auth')<div class="error-message"> {{ $message }} </div>@enderror
            <div class="wrap-input100 mb-4" data-validate = "Entrez un email valide: ex@abc.xyz">
                <input class="input100" type="email" placeholder="Email" wire:model="userName">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="zmdi zmdi-email" aria-hidden="true"></i>
                </span>
            </div>
            @error('password')<div class="error-message"> {{ $message }} </div>@enderror
            <div class="wrap-input100" data-validate = "Mot de passe réquis">
                <input class="input100" type="password" placeholder="Mot de passe" wire:model="password">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                </span>
            </div>
            <div class="text-end pt-1">
                <p class="mb-0"><a href="#" class="text-primary ms-1">Mot de passe oublié ?</a></p>
            </div>
            <div class="container-login100-form-btn">
                <button wire:click.prevent="login" type="submit"  href="#" class="login100-form-btn btn-primary">
                    Se connecter
                </button>
            </div>
            {{-- <div class="text-center pt-3">
                <p class="text-dark mb-0">Vous n'avez pas de compte ?<a href="{{url('register')}}" class="text-primary mx-1">S'inscrire</a></p>
            </div> --}}
            {{-- <div class=" flex-c-m text-center mt-3">
                <p>Ou</p>
                <div class="social-icons">
                    <ul>
                        <li><a class="btn  btn-social btn-block"><i class="fa fa-google-plus text-google-plus"></i> S'inscrire avec Google</a></li>
                        <li><a class="btn  btn-social btn-block mt-2"><i class="fa fa-facebook text-facebook"></i> S'inscrire avec Facebook</a></li>
                    </ul>
                </div>
            </div> --}}
        </form>
    </div>
</div>
<!-- CONTAINER CLOSED -->
</div>

