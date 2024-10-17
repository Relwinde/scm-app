<?php

namespace App\Livewire\Modals\Outils;

use App\Models\User;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;

class CreateUser extends ModalComponent
{
    #[Validate('required')]
    public $nom; 

    #[Validate('required|email')]
    public $email; 

    #[Validate('required')]
    public $profile;

    public function render()
    {

        $profiles = Role::all(['id', 'name']);
        return view('livewire.modals.outils.create-user', ['profiles'=>$profiles, "title"=>"Création d'un nouvel utilisateur"]);
    }

    public function create (){
        $user = User::make([
            'name'=>$this->nom,
            'email'=>$this->email,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        if ($user->save()){
            $user->syncRoles(Role::findById($this->profile));
            $this->dispatch('new-user');
            $this->reset();
        }else{
            $this->dispatch('error');
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
