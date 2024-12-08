<div>
    <div class="table-responsive">
        <table class="table table-striped table-striped table-bordered text-nowrap">
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
                <tr style="font-weight:700;">
                    <th class="wd-15p border-bottom-0"><b>Nom</b></th>
                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                    <tr style="font-weight:600;" wire:key='{{$profile->id}}'>
                        <td>{{$profile->name}}</td>
                        <td name="bstable-actions">
                            <div class="btn-list">
                                {{-- <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button> --}}
                                <button id="bAcep" type="button" class="btn btn-sm btn-primary-light me-2" wire:click="$dispatch('openModal', {component: 'modals.outils.view-profile', arguments: { profile : {{ $profile->id }} }})">
                                    <span class="fe fe-eye"> </span>
                                </button>
                                {{-- <button id="bDel" type="button" class="btn  btn-sm btn-danger">
                                    <span class="fe fe-trash-2"> </span>
                                </button> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{$profiles->links()}}
        </div>
    </div>
</div>