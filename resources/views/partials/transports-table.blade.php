<div class="table-responsive">
    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
        <thead>
            <tr>
                <th class="wd-15p border-bottom-0"><b>Numéro</b></th>
                <th class="wd-15p border-bottom-0"><b>Client</b></th>
                <th class="wd-20p border-bottom-0"><b>Chauffeur</b></th>
                <th class="wd-15p border-bottom-0"><b>Véhicule</b></th>
                <th class="wd-10p border-bottom-0"><b>Itinéraire</b></th>
                <th class="wd-25p border-bottom-0"><b>Actions</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dossiers as $dossier)
                <tr wire:key='{{$dossier->id}}'>
                    <td>{{$dossier->numero}}</td>
                    <td>{{$dossier->client->nom}}</td>
                    <td>{{$dossier->chauffeur->nom}}</td>
                    <td>{{$dossier->vehicule->immatriculation}}</td>
                    <td></td>
                    <td name="bstable-actions">
                        <div class="btn-list">
                            <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                <span class="fe fe-edit"> </span>
                            </button>
                            <button wire:click="$dispatch('openModal', {component: 'modals.view-transport-interne', arguments: { dossier : {{ $dossier->id }} }})" id="bAcep" type="button" class="btn  btn-sm btn-primary">
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
        {{$vehicules->links()}}
    </div>
</div>