<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des dépenses du véhicules: <b>{{$vehicule->immatriculation}}</b></h3>&nbsp; &nbsp;
    </div>
    <div class="card-header">
            <div class="col-6" style="overflow: auto;">
                <div class="card-title" style="display: flex;">
                    <input style="min-width: 100px; max-width:200px" wire:model.live.debounce="search" type="text" class="form-control m-3" placeholder="Recherche...">
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
                </div>
            </div>
            <div class="col">
                <h6 class="">Total : </h6>
                <h3 class="mb-2 number-font" style="font-size: 1.2rem;">{{number_format($total_depenses, 2, '.', ' ')}} FCFA</h3>
            </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered border text-wrap mb-0" id="bonsDeCaisseTable">
                <thead>
                    <tr style="font-weight:700;">
                        <th class="wd-15p border-bottom-0 text-nowrap"><b>Numéro</b></th>
                        <th class="wd-15p border-bottom-0 text-nowrap"><b>Date</b></th>
                        <th class="wd-20p border-bottom-0"><b>Dépenses engagées</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Montant</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Emetteur</b></th>
                        <th class="wd-20p border-bottom-0 text-nowrap"><b>Etape</b></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bonsDeCaisse as $bon)
                        <tr style="font-weight:600;" wire:key='{{$bon->id}}'>
                            <td wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.view-bon', arguments: { bon : {{ $bon->id }} }})" style="cursor: pointer;" style="cursor: pointer;" class="text-nowrap">{{$bon->numero}}</td>
                            <td>{{ $bon->created_at->locale(app()->getLocale())->translatedFormat('j F Y') }}</td>
                            <td>{{$bon->depense}}</td>
                            <td class="text-nowrap">{{number_format($bon->montant_definitif, 2, '.', ' ')}}</td>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$bonsDeCaisse->links()}}
            </div>
        </div>
    </div>

    <div class="card-footer">
        
    </div>
</div>