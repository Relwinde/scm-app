<div>
    <div class="table-responsive">
        <table class="table table-bordered border text-nowrap mb-0">
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
                    <th class="wd-15p border-bottom-0"><b>Email</b></th>
                    <th class="wd-20p border-bottom-0"><b>Profile</b></th>
                    <th class="wd-20p border-bottom-0"><b>Status</b></th>
                    <th class="wd-20p border-bottom-0"><b>Date de création</b></th>
                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr wire:key='{{$user->id}}'>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td></td>
                        <td></td>
                        <td>{{strftime("%e %B %Y", strtotime($user->created_at));}}</td>
                        <td name="bstable-actions">
                            <div class="btn-list">
                                {{-- <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button> --}}
                                <button id="bAcep" type="button" class="btn  btn-sm btn-primary">
                                    <span class="fe fe-eye"> </span>
                                </button>
                                <button id="bDel" type="button" class="btn  btn-sm btn-danger">
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