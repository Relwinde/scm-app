<div class="card form-input-elements">
    <div class="card-header d-flex justify-content-between">
        <h3 class="mb-0 card-title"><b>Profile : {{$profile->name}}</b></h3>
    </div>

    <div class="card-body">
        <div class="row">
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


