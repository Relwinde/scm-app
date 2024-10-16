<div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-nowrap">
            <thead>
                {{-- <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Position</th>
                    <th>Start date</th>
                    <th>Salary</th>
                    <th>E-mail</th>
                    <th>Actions</th>
                </tr> --}}
                <tr>
                    <th class="wd-15p border-bottom-0"><b>Nom</b></th>
                    <th class="wd-20p border-bottom-0"><b>Profile</b></th>
                    <th class="wd-20p border-bottom-0"><b>Status</b></th>
                    <th class="wd-20p border-bottom-0"><b>Date de création</b></th>
                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr wire:key='{{$user->id}}'>
                        <td>     
                            <p class="fs-14 fw-semibold text-dark mb-0">{{$user->name}} </p>
                            <p class="fs-13 text-muted mb-0">{{$user->email}}</p>
                        </td>
                        <td>@foreach ($user->roles as $role)
                            <span class="badge fw-semibold badge-pill bg-secondary-transparent text-secondary fs-11">
                                {{$role->name}}
                            </span>
                        @endforeach</td>
                        <td></td>
                        <td> <span class="text-muted fs-13">{{strftime("%e %B %Y", strtotime($user->created_at));}}</span></td>
                        <td name="bstable-actions">
                            <div class="btn-list">
                                {{-- <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button> --}}
                                <button wire:click="$dispatch('openModal', {component: 'modals.outils.view-user', arguments: { user : {{ $user->id }} }})" type="button" class="btn btn-sm btn-primary-light me-2">
                                    <span class="fe fe-eye"> </span>
                                </button>
                                <button id="bDel" type="button" class="btn  btn-sm btn-danger" >
                                    <span class="fe fe-trash-2"> </span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{$users->links()}}
        </div>
    </div>
</div>