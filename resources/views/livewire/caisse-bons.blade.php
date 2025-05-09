<div>
    <div class="d-flex align-items-left">
        <div class="main-header-center m-3 d-lg-block">
                <input   wire:model.live.debounce="search" type="text" class="form-control" placeholder="Recherche...">
        </div>
    </div>
    <div>
        <div wire:poll.keep-alive.3s class="table-responsive">
            <table class="table table-striped table-bordered border text-wrap mb-0">
                <thead>
                    <tr style="font-weight:700;">
                        <th class="text-nowrap" style="max-width: 30px;"></th>
                        <th class="wd-15p border-bottom-0 text-nowrap"><b>Numéro</b></th>
                        <th class="wd-20p border-bottom-0"><b>Dépenses engagées</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Montant</b></th>
                        <th class="wd-15p border-bottom-0 text-nowrap"><b>Dossier/Véhicule</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Emetteur</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Mode de paiement</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Etape</b></th>
                        <th class="wd-25p border-bottom-0 text-nowrap"><b>Actions</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bonsDeCaisse as $bon)
                        <tr style="font-weight:600;" wire:key='{{$bon->id}}'>
        <td class="text-nowrap" style="max-width: 30px;">{!! $bon->files->count() ? "<i class=\"fe fe-paperclip\"></i>".$bon->files->count() : "" !!}</td>
                            <td wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.view-bon', arguments: { bon : {{ $bon->id }} }})" style="cursor: pointer;" class="text-nowrap">{{$bon->numero}}</td>
                            <td>{{$bon->depense}}</td>
                            <td class="text-nowrap">{{number_format($bon->montant_definitif, 2, '.', ' ')}}</td>
                            <td class="text-nowrap">{{$bon->dossier->numero ?? $bon->transport->numero ?? $bon->vehicule->immatriculation ?? "AUTRES"}}</td>
                            <td class="text-nowrap">{{$bon->user->name}}</td>
                            <td class="text-nowrap">
                                @switch($bon->type_paiement)
                                    @case("ESPECE")
                                        Espèces
                                        @break
                                    @case("CHEQUE")
                                        Chèque
                                        @break
                                    @default
                                @endswitch
                            </td>
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
                                    {{-- <button type="button" class="btn  btn-sm btn-danger">Payer
                                            <span class="fa fa-ticket"> </span>
                                    </button> --}}
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
</div>
