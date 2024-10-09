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
                    <th class="wd-15p border-bottom-0"><b>Numéro</b></th>
                    <th class="wd-15p border-bottom-0"><b>Dossier</b></th>
                    <th class="wd-20p border-bottom-0"><b>Emetteur</b></th>
                    <th class="wd-20p border-bottom-0"><b>Montant</b></th>
                    <th class="wd-20p border-bottom-0"><b>Dépenses engagées</b></th>
                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bonsDeCaisse as $bon)
                    <tr wire:key='{{$bon->id}}'>
                        <td>{{$bon->numero}}</td>
                        <td>{{$bon->dossier->numero ?? $bon->transport->numero ?? "AUTRES"}}</td>
                        <td>{{$bon->user->name}}</td>
                        <td>{{number_format($bon->montant, 2, '.', ' ')}}</td>
                        <td>{{$bon->depense}}</td>
                        
                        <td name="bstable-actions">
                            <div class="btn-list">
                                {{-- <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button> --}}
                                {{-- <button wire:click="$dispatch('openModal', {component: 'modals.view-bon', arguments: { bon : {{ $bon->id }} }})" id="bAcep" type="button" class="btn  btn-sm btn-primary">
                                    <span class="fe fe-eye"> </span>
                                </button> --}}
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
            {{$bonsDeCaisse->links()}}
        </div>
    </div>
</div>

