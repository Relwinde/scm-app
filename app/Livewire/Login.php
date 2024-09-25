<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    #[Rule(['required'])]
    public $userName;

    #[Rule(['required'])]
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
            // $this->redirect(BillOfLading::class, navigate: true);
        }

        $this->reset(['password']);
        throw ValidationException::withMessages(['auth' => "Les informations d'identification fournies ne correspondent à aucun compte"]);

    }

}
