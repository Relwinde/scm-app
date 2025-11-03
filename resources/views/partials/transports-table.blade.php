<div class="table-responsive">
    <table class="table table-striped table-bordered text-wrap border-bottom" id="responsive-datatable">
        <thead>
            <tr style="font-weight:700;">
                <th class="wd-15p border-bottom-0"><b>Numéro</b></th>
                <th class="wd-15p border-bottom-0"><b>Client</b></th>
                <th class="wd-20p border-bottom-0"><b>Chauffeur</b></th>
                <th class="wd-15p border-bottom-0"><b>Véhicule</b></th>
                <th class="wd-25p border-bottom-0"><b>Actions</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dossiers as $dossier)
                <tr style="font-weight:600;" wire:key='{{$dossier->id}}'>
                    <td wire:click="$dispatch('openModal', {component: 'modals.view-transport-interne', arguments: { dossier : {{ $dossier->id }} }})" style="cursor: pointer;">
                        <h1>{{$dossier->numero}}</h1> 
                        <h6 class="text-primary" style="font-size: 13px;">{{ mb_strtoupper($dossier->status?->name, 'UTF-8') }}</h6>
                    </td>
                    <td>{{$dossier->client->nom}}</td>
                    <td>{{$dossier->chauffeur->nom ?? ''}}</td>
                    <td>{{$dossier->vehicule->immatriculation ?? ''}}</td>
                    <td name="bstable-actions">
                        <div class="btn-list">
                            {{-- <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                <span class="fe fe-edit"> </span>
                            </button> --}}
                            <button wire:click="$dispatch('openModal', {component: 'modals.view-transport-interne', arguments: { dossier : {{ $dossier->id }} }})" id="bAcep" type="button" class="btn  btn-sm btn-primary">
                                <span class="fe fe-eye"> </span>
                            </button>
                            @can('Supprimer transport interne')
                                <button wire:click='delete({{$dossier->id}})' wire:confirm="Souhaitez vous vraiment supprimer cet élément?" id="bDel" type="button" class="btn  btn-sm btn-danger">
                                    <span class="fe fe-trash-2"> </span>
                                </button>
                            @endcan
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{$dossiers->links()}}
    </div>
</div>


@script
    <script>
        $wire.on('dossier-delete-error', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        message: "Une erreur est survenue, ce dossier a déjà fait l'objet de bons de caisse"
                    });
                });
            }).call(this);
        });

        $wire.on('dossier-delete-success', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le dossier a été supprimé avec succès."
                    });
                });
            }).call(this);
        });
    </script>
@endscript