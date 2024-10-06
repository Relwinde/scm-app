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
                    <th class="wd-15p border-bottom-0"></th>
                    <th class="wd-15p border-bottom-0"><b>Nom</b></th>
                    <th class="wd-20p border-bottom-0"><b>Code client</b></th>
                    <th class="wd-20p border-bottom-0"><b>Téléphone</b></th>
                    <th class="wd-20p border-bottom-0"><b>Email</b></th>
                    <th class="wd-20p border-bottom-0"><b>N° IFU</b></th>
                    <th class="wd-10p border-bottom-0"><b>N° RCCM</b></th>
                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr wire:key='{{$client->id}}'>
                        <td style="max-width: 10px">{{$loop->iteration}}</td>
                        <td>{{$client->nom}}</td>
                        <td>{{$client->code}}</td>
                        <td>{{$client->telephone}}</td>
                        <td>{{$client->email}}</td>
                        <td>{{$client->ifu}}</td>
                        <td>{{$client->rccm}}</td>
                        <td name="bstable-actions">
                            <div class="btn-list">
                                {{-- <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button> --}}
                                <button wire:click="$dispatch('openModal', {component: 'modals.outils.view-client', arguments: { client : {{ $client->id }} }})" id="bAcep" type="button" class="btn  btn-sm btn-primary">
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
            {{$clients->links()}}
        </div>
    </div>
</div>

