<div>
    <div class="d-flex align-items-left">
                    {{-- <input style="min-width: 100px; max-width:200px" wire:model.live.debounce="search" type="text" class="form-control m-3" placeholder="Recherche..."> --}}
                    @if ($start_date || $end_date)
                    <div>
                        <button class="btn btn-sm btn-outline-primary" wire:click="resetDates">
                            <i class="icon icon-reload"></i>
                        </button>
                    </div>
                    @endif
                    <div class="input-group m-3" style="min-width: 100px; max-width:200px">
                        <div class="input-group-text">
                            <div class="">
                                Du :
                            </div>
                        </div><input wire:model.live='start_date' class="form-control" placeholder="Du" type="date">
                    </div>
                    <div class="input-group m-3" style="min-width: 100px; max-width:200px">
                        <div class="input-group-text">
                            <div class="">
                                 Au :
                            </div>
                        </div><input wire:model.live='end_date' class="form-control" placeholder="Au" type="date">
                    </div>
                    @if ($start_date || $end_date)
                        <div class="m-3">
                            <h6 class="">Entrées : </h6>
                            <h3 class="mb-2 number-font" style="font-size: 1.2rem;">{{number_format($totalEntrees, 2, '.', ' ')}} FCFA</h3>
                        </div>
                        <div class="m-3">
                            <h6 class="">Sorties : </h6>
                            <h3 class="mb-2 number-font" style="font-size: 1.2rem;">{{number_format($totalSorties, 2, '.', ' ')}} FCFA</h3>
                        </div> 
                        <div class="m-3">
                            <button class="btn btn-outline-primary" wire:click="export">
                                <i class="fa fa-download"></i>
                            </button>
                        </div>
                    @endif
    </div>
    <div>
        <div wire:poll.keep-alive.3s class="table-responsive">
            <table class="table table-striped table-bordered border text-wrap mb-0">
                <thead>
                    <tr style="font-weight:700;">
                        <th class="wd-15p border-bottom-0 text-nowrap"><b>Type</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Libellé</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Montant</b></th>
                        <th class="wd-15p border-bottom-0 text-nowrap"><b>Solde après opération</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Date</b></th>
                        <th class="wd-25p border-bottom-0 text-nowrap"><b>Actions</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mouvements as $mouvement)
                        <tr style="font-weight:600;" wire:key='{{$mouvement->id}}'>
                            <td class="text-nowrap">
                                @if ($mouvement->bon_de_caisse_id)
                                    <i class="fa fa-caret-up fa-1x text-danger me-1"></i>DEPENSE	
                                @endif
                                @if ($mouvement->depot_id)
                                    <i class="fa fa-caret-down fa-1x text-primary me-1"></i>DEPOT 
                                @endif
                                @if ($mouvement->ajustement_bon)
                                    @if ($mouvement->ajustement_bon->type == "RESTITUTION")
                                        <i class="fa fa-caret-down fa-1x text-primary me-1"></i>RESTITUTION
                                    @endif
                                    @if ($mouvement->ajustement_bon->type == "EXCEDANT")
                                        <i class="fa fa-caret-up fa-1x text-danger me-1"></i>EXCEDANT
                                    @endif
                                @endif
                                
                            </td>
                            <td class="text-nowrap">
                                @if ($mouvement->bon_de_caisse_id)
                                    {{$mouvement->bon_de_caisse->depense}}
                                @endif
                                @if ($mouvement->depot_id)
                                    {{$mouvement->depot->libelle}}
                                @endif
                                @if ($mouvement->ajustement_bon)
                                    {{$mouvement->ajustement_bon->libelle}}
                                @endif
                            </td>
                            <td class="text-nowrap" >{{number_format($mouvement->montant, 2, '.', ' ')}}</td>
                            <td class="text-nowrap">{{number_format($mouvement->solde_after, 2, '.', ' ')}}</td>
                            <td class="text-nowrap">{{ $mouvement->created_at->locale(app()->getLocale())->translatedFormat('j F Y à H:i') }}</td>
                            <td class="text-nowrap" name="bstable-actions">
                                <div class="btn-list">
                                    @if($mouvement->bon_de_caisse_id)
                                        <button wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.view-bon', arguments: { bon : {{ $mouvement->bon_de_caisse_id }} }})" type="button" class="btn  btn-sm btn-primary">
                                            <span class="fe fe-eye"> </span>
                                        </button>
                                    @endif

                                    @if($mouvement->ajustement_bon)
                                        <button wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.view-bon', arguments: { bon : {{ $mouvement->ajustement_bon->bon_de_caisse_id }} }})" type="button" class="btn  btn-sm btn-primary">
                                            <span class="fe fe-eye"> </span>
                                        </button>
                                    @endif
                                    
                                    @if ($mouvement->depot_id)
                                        <button wire:click="$dispatch('openModal', {component: 'modals.depot.view-depot', arguments: { depot : {{ $mouvement->depot_id }} }})" type="button" class="btn  btn-sm btn-primary">
                                            <span class="fe fe-eye"> </span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$mouvements->links()}}
            </div>
        </div>
    </div>
</div>