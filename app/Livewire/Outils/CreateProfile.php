<?php

namespace App\Livewire\Outils;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class CreateProfile extends Component
{
    public function render()
    {

        $permissions = Permission::select(['id', 'name']);

        return view('livewire.outils.create-profile', ['permissions'=>$permissions, 'header_title'=>'Nouveau profile', 'create_link'=>'new-role', 'button_title'=>'Nouveau profile']);
    }
}
