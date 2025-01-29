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

    public $ownedPermissions = "1";

    use WithPagination;


    public function render()
    {
        if($this->ownedPermissions == "1"){
                $permissions = $this->profile->permissions()
                ->where('name', 'like', "%{$this->search}%")
                ->paginate(10, ['id', 'name'], 'permission-pagination');
        }
        if($this->ownedPermissions == "0"){
            $permissions = Permission::select(['id', 'name'])
                ->where('name', 'like', "%{$this->search}%")
                ->paginate(10, '*', 'permission-pagination');
        }
        
            
        
        return view('livewire.modals.outils.view-profile', ['permissions'=>$permissions,]);
    }

    public function givePermissionTo (Permission $permission){
        $this->profile->givePermissionTo($permission->name);
    }

    public function revokePermissionTo (Permission $permission){
        $this->profile->revokePermissionTo($permission->name);
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
