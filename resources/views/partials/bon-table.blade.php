<div>
    <div wire:poll.keep-alive.5s="notificate" class="table-responsive">
        <table class="table table-striped table-bordered border text-wrap mb-0" id="bonsDeCaisseTable">
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
                    <th class="text-nowrap" style="max-width: 30px;"></th>
                    <th class="wd-15p border-bottom-0 text-nowrap"><b>Numéro</b></th>
                    <th class="wd-20p border-bottom-0"><b>Dépenses engagées</b></th>
                    <th class="wd-20p border-bottom-0 text-nowrap"><b>Montant</b></th>
                    <th class="wd-15p border-bottom-0 text-nowrap"><b>Dossier/Véhicule</b></th>
                    <th class="wd-20p border-bottom-0 text-nowrap"><b>Emetteur</b></th>
                    <th class="wd-20p border-bottom-0 text-nowrap"><b>Etape</b></th>
                    <th class="wd-25p border-bottom-0 text-nowrap"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bonsDeCaisse as $bon)
                    <tr style="font-weight:600;" wire:key='{{$bon->id}}'>
                        <td class="text-nowrap" style="max-width: 45px;">{!! $bon->files->count() ? "<i class=\"fe fe-paperclip\"></i>".$bon->files->count() : "" !!} {!! $bon->commentaires->count() ? "<i class=\"icon icon-bubble\"></i>".$bon->commentaires->count() : "" !!}</td>
                        <td wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.view-bon', arguments: { bon : {{ $bon->id }} }})" style="cursor: pointer;" style="cursor: pointer;" class="text-nowrap">{{$bon->numero}}</td>
                        <td>{{$bon->depense}}</td>
                        <td class="text-nowrap">{{number_format($bon->montant_definitif, 2, '.', ' ')}}</td>
                        <td class="text-nowrap">{{$bon->dossier->numero ?? $bon->transport->numero ?? $bon->vehicule->immatriculation ?? "AUTRES"}}</td>
                        <td class="text-nowrap">{{$bon->user->name}}</td>
                        <td class="text-nowrap">@switch($bon->etape)
                            @case("EMETTEUR")
                                <span class="tag tag-azure">Emetteur</span>
                                @break
                            @case("RESPONSABLE")
                                <span class="tag tag-indigo">Responsable</span>
                                @break
                            @case("MANAGER")
                                <span class="tag tag-purple">Manager</span>
                                @break
                            @case("RAF")
                                <span class="tag tag-blue">Responsable finance</span>
                                @break
                            @case("CAISSE")
                                <span class="tag tag-red">Caisse</span>
                                @break
                            @case("PAYE")
                                <span class="tag tag-orange">Payé</span>
                                @break
                            @case("CLOS")
                                <span class="tag tag-gray-dark">Clos</span>
                                @break
                            @default
                                
                        @endswitch</td>
                        <td class="text-nowrap" name="bstable-actions">
                            <div class="btn-list">
                                {{-- <button id="bEdit" type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button> --}}
                                {{-- <button wire:click="$dispatch('openModal', {component: 'modals.view-bon', arguments: { bon : {{ $bon->id }} }})" id="bAcep" type="button" class="btn  btn-sm btn-primary">
                                    <span class="fe fe-eye"> </span>
                                </button> --}}
                                <button wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.view-bon', arguments: { bon : {{ $bon->id }} }})" type="button" class="btn  btn-sm btn-primary">
                                    <span class="fe fe-eye"> </span>
                                </button>
                                @if (($bon->etape == "EMETTEUR" && $bon->user->id == Auth::user()->id) || ($bon->etape == "RESPONSABLE" && Auth::user()->can("Envoyer bon de caisse au manager")) || ($bon->etape == "MANAGER" && Auth::user()->can("Envoyer bon de caisse à la caisse"))) 
                                    <button wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.edit-bon', arguments: { bon : {{ $bon->id }} }})" type="button" class="btn  btn-sm btn-primary">
                                        <span class="fe fe-edit"> </span>
                                    </button>
                                @endif
                                @if ($bon->etape == "EMETTEUR" && $bon->user->id == Auth::user()->id) 
                                    <button wire:confirm="Souhaitez vous vraiment supprimer ce élément?" wire:click='delete({{$bon->id}})' type="button" class="btn  btn-sm btn-danger">
                                        <span class="fe fe-trash-2"> </span>
                                    </button>
                                @endif

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

@script
    <script>
        $wire.on('bon-delete-error', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        message: "Une erreur est survenue, ce bon de caisse ne peut être supprimé."
                    });
                });
            }).call(this);
        });

        $wire.on('bon-delete-success', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le bon de caisse a été supprimé avec succès."
                    });
                });
            }).call(this);
        });

        $wire.on('notification', () => {
            (function () {
                $(function () {
                    var audio = new Audio('/public/audio/notify.mp3');
                    audio.play();
                    return $.growl({
                        title: "Notification :",
                        message: "Vous avez un nouveau bon de caisse."
                    });
                });
            }).call(this);

            
        });
    </script>
@endscript

