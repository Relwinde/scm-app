<div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered border text-wrap mb-0">
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
                    <th class="wd-15p border-bottom-0"><b>Numéro</b></th>
                    <th class="wd-15p border-bottom-0"><b>Client</b></th>
                    <th class="wd-20p border-bottom-0"><b>Fournisseur</b></th>
                    <th class="wd-20p border-bottom-0"><b>N° LTA/BL</b></th>
                    <th class="wd-20p border-bottom-0"><b>N° SYLVIE</b></th>
                    <th class="wd-20p border-bottom-0"><b>N° de commande</b></th>
                    <th class="wd-15p border-bottom-0"><b>Date de création</b></th>
                    <th class="wd-10p border-bottom-0"><b>N° de déclaration</b></th>
                    {{-- <th class="wd-10p border-bottom-0"><b>Status</b></th> --}}
                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dossiers as $dossier)
                    <tr style="font-weight:600;" wire:key='{{$dossier->id}}'>
                        <td wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" style="cursor:pointer;"> <h1>{{$dossier->numero}} </h1> <h6 class="text-primary" style="font-size: 13px;">{{ mb_strtoupper($dossier->status?->name, 'UTF-8') }}</h6></td>
                        <td>{{$dossier->client->nom}}</td>
                        <td>{{$dossier->fournisseur}}</td>
                        <td>{{$dossier->num_lta_bl}}</td>
                        <td>{{$dossier->num_sylvie}}</td>
                        <td>{{$dossier->num_commande}}</td>
                        <td>{{$dossier->created_at->locale(app()->getLocale())->translatedFormat('j F Y') }}</td>
                        <td>{{$dossier->num_declaration}}</td>
                        {{-- <td>
                            <div class="mt-sm-1 d-block">
                                <span
                                    class="badge bg-success rounded-pill p-2 px-3">{{ mb_strtoupper($dossier->status?->name, 'UTF-8') }}</span>
                            </div>
                        </td> --}}
                        <td name="bstable-actions">
                            <div class="btn-list">
                                {{-- <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button> --}}
                                <button wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" type="button" class="btn  btn-sm btn-primary">
                                    <span class="fe fe-eye"> </span>
                                </button>
                                @can('Supprimer dossier')
                                        <button wire:click='delete({{$dossier->id}})' wire:confirm="Souhaitez vous vraiment supprimer cet élément?" type="button" class="btn  btn-sm btn-danger">
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

