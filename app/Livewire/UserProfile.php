<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class UserProfile extends ModalComponent
{
    public $updatePassword = false;
    public $name;
    public $email;
    public $actualPassword;
    public $password;
    public $password_confirmation;


    public function mount (){
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function render()
    {
        return view('livewire.user-profile', ['title'=> "Modification de mes données de connexion"]);
    }

    public function update (){
        if ($this->updatePassword){
            if ($this->validate([ 
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:6',
                'actualPassword' => 'required|current_password:web',
            ], [
                'required' => 'Ce champ est obligatoire',
                'email' => 'Entrez une adresse email valide',
                'min' => 'Valeur trop courte',
                'confirmed' => 'Les mots de passe ne concordent pas',
                'current_password' => 'Vous avez entré un mauvais mot de passe',
            ])){
                $user = Auth::user();
                $user->name = $this->name;
                $user->email = $this->email;
                $user->password = Hash::make($this->password);
                if ($user->save()){
                    request()->session()->flash("success", "Vos informations ont été mises à jour.");
                    $this->closeModal();
                }else{
                    request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
                    $this->closeModal();
                }
            }
        }else{
            if ($this->validate([ 
                'name' => 'required',
                'email' => 'required|email'
            ])){
                $user = Auth::user();
                $user->name = $this->name;
                $user->email = $this->email;
                if ($user->save()){
                    request()->session()->flash("success", "Vos informations ont été mises à jour.");
                    $this->closeModal();
                }else{
                    request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
                    $this->closeModal();
                }
            }
        }
    }
}
