<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    #[Validate('required', message: 'Entrez une adresse mail valide')]
    #[Validate('email', message: 'Entrez une adresse mail valide')]
    public $userName;

    #[Validate('required', message: 'Entrez votre mot de passe')]
    public $password;

    public function render()
    {
        return view('livewire.login')->layout('layouts.custom-master');
    }

    public function login (){
        $this->validate();

        if (Auth::attempt(['email'=>$this->userName, 'password'=>$this->password])) {
            // $request->session()->regenerate();
            $this->reset();
            $this->redirect(Home::class);
        }

        $this->reset(['password']);
        throw ValidationException::withMessages(['auth' => "Les informations d'identification fournies ne correspondent à aucun compte"]);

    }

}
