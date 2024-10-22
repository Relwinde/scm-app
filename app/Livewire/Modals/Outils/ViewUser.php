<?php

namespace App\Livewire\Modals\Outils;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;

class ViewUser extends ModalComponent
{
    public User $user;

    #[Validate('required')]
    public $name; 

    #[Validate('required')]
    public $email;
    
    #[Validate('required')]
    public $profile; 

    public $edit = false;

    public function mount (){
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->profile = $this->user->roles->first()->id;
    }

    public function render()
    {
        $profiles = Role::all(['id', 'name']);
        return view('livewire.modals.outils.view-user', ['profiles'=>$profiles, "title"=>"Modification d'un utilisateur"]);
    }

    public function update (){
        $this->user->name = $this->name;
        $this->user->email = $this->email;

        if ($this->user->save()){
            $this->user->syncRoles(Role::findById($this->profile));
            $this->dispatch('new-user');
            $this->closeModal();
        }else{
            $this->dispatch('error');
        }
    }
    public function setEdit(){
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->edit=true;
        }
    }
    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function resetPassword (){
        $this->user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        if ($this->user->save()){
            $this->dispatch('password-reset');
            $this->closeModal();
        }else{
            $this->dispatch('error');
        }
    }
}
