<div>
    <div wire:poll.3s class="table-responsive">
        <table class="table table-striped table-bordered border text-nowrap mb-0">
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
                    <th class="wd-20p border-bottom-0"><b>Etape</b></th>
                    <th class="wd-25p border-bottom-0"><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bonsDeCaisse as $bon)
                    <tr wire:key='{{$bon->id}}'>
                        <td>{{$bon->numero}}</td>
                        <td>{{$bon->dossier->numero ?? $bon->transport->numero ?? "AUTRES"}}</td>
                        <td>{{$bon->user->name}}</td>
                        <td>{{number_format($bon->montant_definitif, 2, '.', ' ')}}</td>
                        <td>{{$bon->depense}}</td>
                        <td>@switch($bon->etape)
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
                        <td name="bstable-actions">
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
                                    <button id="bDel" type="button" class="btn  btn-sm btn-danger">
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

