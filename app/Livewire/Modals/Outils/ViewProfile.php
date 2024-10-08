<?php

namespace App\Livewire\Modals\Outils;

use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;

class ViewProfile extends ModalComponent
{

    public Role $profile;

    public $search;

    use WithPagination;


    public function render()
    {
        $permissions = Permission::select(['id', 'name'])
            ->where('name', 'like', "%{$this->search}%")
            ->paginate(10, '*', 'dossier-pagination');
        return view('livewire.modals.outils.view-profile', ['permissions'=>$permissions,]);
    }

    public function givePermissionTo (Permission $permission){
        $this->profile->givePermissionTo($permission->name);
    }

    public function revokePermissionTo (Permission $permission){
        $this->profile->revokePermissionTo($permission->name);
    }
}
