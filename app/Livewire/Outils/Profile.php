<?php

namespace App\Livewire\Outils;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Profile extends Component
{
    public $search;

    use WithPagination;
    

    #[On('new-profile')]
    public function render()
    {
        $profiles = Role::where('name', 'like', "%{$this->search}%")
                    ->orderBy('name')
                    ->paginate(10, '*', 'roles-pagination');

        return view('livewire.outils.profile', ['profiles'=>$profiles, 'header_title'=>'Profiles', 'create_modal'=>'modals.outils.create-profile', 'button_title'=>'Nouveau profile']);
    }
}
