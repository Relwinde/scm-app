<?php

namespace App\Livewire\Modals\Outils;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class CreateProfile extends ModalComponent
{

    public $name;

    public function render()
    {
        return view('livewire.modals.outils.create-profile',["title"=>"Création d'un nouveau profile"]);
    }

    public function create(){
        $profile = Role::make([
            'name'=>$this->name
        ]);
        if($profile->save()){
            $this->dispatch('new-profile');
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
