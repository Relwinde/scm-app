<div>
    <div class="mb-4 ">
        <div class="selectgroup selectgroup-pills">
            @foreach ($dossiersStatus as $status)
                <label class="selectgroup-item">
                    <input wire:model.live.debounce="selectedStatus" type="checkbox" name="value" value="{{ $status->id }}" class="selectgroup-input">
                    <span class="selectgroup-button">{{ $status->name }}</span>
                </label>
            @endforeach
                <div class="btn-list checkboxbtns">
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="btncheck1" value="TTC" wire:model.live.debounce="selectedRegimes">
                        <label class="btn btn-outline-primary" for="btncheck1">TTC</label>

                        <input type="checkbox" class="btn-check" id="btncheck3" value="EXO" wire:model.live.debounce="selectedRegimes">
                        <label class="btn btn-outline-primary" for="btncheck3">EXO</label>
                    </div>
                </div>
        </div>
    </div>
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
                    <th class="wd-10p border-bottom-0"><b>N° de déclaration</b></th>
                    <th class="wd-15p border-bottom-0"><b>Date de création</b></th>
                    {{-- <th class="wd-10p border-bottom-0"><b>Status</b></th> --}}
                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dossiers as $dossier)
                    <tr style="font-weight:600;" wire:key='{{$dossier->id}}'>
                        <td wire:click="$dispatch('openModal', {component: 'modals.view-dossier', arguments: { dossier : {{ $dossier->id }} }})" style="cursor:pointer;"> <h1>{{$dossier->numero}} 
                            @if ($dossier->regime == "TTC" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def']) && !$dossier->hasPassedThroughAny (['eng_dep']))
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Ce dossier est en attente d'enregistrement et de dépôt en douane" class="alert-inner--icon">
                                <i class="fe fe-info" style="font-size: 1.3em; animation: flash 1s infinite alternate;"></i>
                                </span>
                                <style> 
                                    @keyframes flash {
                                        0% { opacity: 1; }
                                        50% { opacity: 0.2; }
                                        100% { opacity: 1; }
                                    }
                                </style>
                            @endif

                            @if ($dossier->regime == "TTC" && $dossier->hasPassedThrough (['cod', 'fm_prov', 'fm_def', 'eng_dep', 'bae']) && !$dossier->hasPassedThroughAny (['lvr']))
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="En attente du bordereau de livraison signé." class="alert-inner--icon">
                                <i class="fe fe-info" style="font-size: 1.3em; animation: flash 1s infinite alternate;"></i>
                                </span>
                                <style> 
                                    @keyframes flash {
                                        0% { opacity: 1; }
                                        50% { opacity: 0.2; }
                                        100% { opacity: 1; }
                                    }
                                </style>
                            @endif
                        
                            </h1> <h6 class="text-primary" style="font-size: 13px;">{{ mb_strtoupper($dossier->status?->name, 'UTF-8') }}</h6>
                        </td>
                        <td>{{$dossier->client->nom}}</td>
                        <td>{{$dossier->fournisseur}}</td>
                        <td>{{$dossier->num_lta_bl}}</td>
                        <td>{{$dossier->num_sylvie}}</td>
                        <td>{{$dossier->num_commande}}</td>
                        <td>{{$dossier->num_declaration}} <h6 class="text-danger" style="font-size: 13px;">{{ mb_strtoupper($dossier->regime, 'UTF-8') }}</h6></td>
                        <td>{{$dossier->created_at->locale(app()->getLocale())->translatedFormat('j F Y') }}</td>
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

