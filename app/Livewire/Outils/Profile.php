<?php

namespace App\Livewire\Outils;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Profile extends Component
{
    public $search;

    use WithPagination;
    
    public function render()
    {
        $profiles = Role::where('name', 'like', "%{$this->search}%")
                    ->orderBy('name')
                    ->paginate(10, '*', 'roles-pagination');

        return view('livewire.outils.profile', ['profiles'=>$profiles, 'header_title'=>'Profiles', 'create_link'=>'new-role', 'button_title'=>'Nouveau profile']);
    }
}
