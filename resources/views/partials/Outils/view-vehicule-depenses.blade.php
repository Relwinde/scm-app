<div class="card">
    <div class="card-header">
        <h3 class="card-title">Liste des dépenses du véhicules: <b>{{$vehicule->immatriculation}}</b></h3>&nbsp; &nbsp;
    </div>

    <div class="card-header">
        <div class="card-title">
            <input   wire:model.live.debounce="search" type="text" class="form-control" placeholder="Recherche...">
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
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
                        <th class="wd-15p border-bottom-0 text-nowrap"><b>Numéro</b></th>
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