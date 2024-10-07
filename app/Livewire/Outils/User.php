<?php

namespace App\Livewire\Outils;

use App\Models\User as ModelsUser;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class User extends Component
{

    public $search;

    use WithPagination;

    #[On('new-user')]
    public function render()
    {
        $users = ModelsUser::latest()
            ->where('name', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->paginate(10, '*', 'users-pagination');

        return view('livewire.outils.user', ['users'=>$users, 'header_title'=>'Utilisateurs', 'create_modal'=>'modals.outils.create-user', 'button_title'=>'Nouveau utilisateur']);
    }
}
