<div class="card form-input-elements">
    <div class="card-header d-flex justify-content-between">
        <h3 class="mb-0 card-title"><b>Profile : {{$profile->name}}</b></h3>
    </div>
    
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-4">
                    <label class="form-label">Chercher une permission</label>
                    <div class="row gutters-xs">
                        <div class="col">
                            <input wire:model.live.debounce='search' type="text" class="form-control" placeholder="Chercher une permission">
                        </div>
                        <span class="col-auto">
                            <button class="btn btn-primary" type="button"><i class="fe fe-search"></i></button>
                        </span>
                    </div>
                </div>
                <div class="mb-4 form-elements">
                    <div class="btn-list">
                        <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                            <input wire:model.live='ownedPermissions' type="radio" class="custom-control-input" name="example-radios" value="1">
                            <span class="custom-control-label">Permissions du profile</span>
                        </label>
                        <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                            <input wire:model.live='ownedPermissions' type="radio" class="custom-control-input" name="example-radios" value="0">
                            <span class="custom-control-label">Toutes les permissions</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 table-responsive">
                <table class="table table-striped table-bordered text-nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0"><b>Nom</b></th>
                            <th class="wd-15p border-bottom-0"><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr wire:key='{{$permission->id}}'>
                                <td>{{$permission->name}}</td>
                                <td><div class="btn-list">
                                    @if ($profile->hasPermissionTo($permission->name))
                                        <button wire:click='revokePermissionTo({{$permission->id}})' id="bAcep" type="button" class="btn btn-sm btn-danger-light me-2">
                                            <span class="fe fe-minus"> </span>
                                        </button>
                                    @else
                                        <button wire:click='givePermissionTo({{$permission->id}})' id="bAcep" type="button" class="btn btn-sm btn-primary-light me-2">
                                            <span class="fe fe-plus"> </span>
                                        </button>
                                    @endif
                                </div></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$permissions->links()}}
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        
    </div>
</div>


