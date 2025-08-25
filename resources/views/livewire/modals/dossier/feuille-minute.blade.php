<div>
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>Feuille minute du dossier {{$dossier->numero}}</b></h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered border text-wrap mb-0" id="bonsDeCaisseTable">
                    <thead>
                        <tr style="font-weight:700;">
                            <th class="text-nowrap" style="max-width: 30px;"></th>
                            <th class="wd-15p border-bottom-0 text-nowrap"><b>Nom</b></th>
                            <th class="wd-15p border-bottom-0 text-nowrap"><b>Nomenclature</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>FOB Devise</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>FOB XOF</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>Fret</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>Autres frais</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>Assurance</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>CAF</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>Poids brut</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>Poids net</b></th>
                            <th class="wd-20p border-bottom-0"><b>Quantité supplémentaire</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form wire:submit.prevent="createArticle">
                            <tr style="font-weight:600;" >
                                <td class="text-nowrap"></td>
                                <td class="text-nowrap">
                                    <input wire:model='name' type="text" class="form-control" name="name" placeholder="Nom">
                                    @error('name')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='code' type="text" class="form-control" name="code" placeholder="Nomenclature">
                                    @error('code')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='fob_devis' type="text" class="form-control" name="fob_devis" placeholder="FOB Devise">
                                    @error('fob_devis')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='fob_xof' type="text" class="form-control" name="fob_xof" placeholder="FOB XOF">
                                    @error('fob_xof')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='fret' type="text" class="form-control" name="fret" placeholder="Fret">
                                    @error('fret')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='autres_frais' type="text" class="form-control" name="autres_frais" placeholder="Autres frais">
                                    @error('autres_frais')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='assurance' type="text" class="form-control" name="assurance" placeholder="Assurance">
                                    @error('assurance')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='caf' type="text" class="form-control" name="caf" placeholder="CAF">
                                    @error('caf')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='poids_brut' type="text" class="form-control" name="poids_brut" placeholder="Poids brut">
                                    @error('poids_brut')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='poids_net' type="text" class="form-control" name="poids_net" placeholder="Poids net">
                                    @error('poids_net')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='quantite_supp' type="text" class="form-control" name="quantite_supp" placeholder="Quantité supplémentaire">
                                    @error('quantite_supp')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap" style="width: 1%;">
                                    <button wire:click="createArticle" class="btn btn-primary">+</button>
                                </td>
                            </tr>
                        </form>
                        
                        @foreach ($articles as $article)
                            <tr style="font-weight:600;" wire:key='{{$article->id}}'>
                                <td class="text-nowrap"> {{$loop->iteration}}</td>
                                <td class="text-nowrap">{{$article->name}}</td>
                                <td class="text-nowrap">{{$article->code}}</td>
                                <td class="text-nowrap">{{$article->fob_devis}}</td>
                                <td class="text-nowrap">{{$article->fob_xof}}</td>
                                <td class="text-nowrap">{{$article->fret}}</td>
                                <td class="text-nowrap">{{$article->autres_frais}}</td>
                                <td class="text-nowrap">{{$article->assurance}}</td>
                                <td class="text-nowrap">{{$article->caf}}</td>
                                <td class="text-nowrap">{{$article->poids_brut}}</td>
                                <td class="text-nowrap">{{$article->poids_net}}</td>
                                <td class="text-nowrap">{{$article->quantite_supp}}</td>
                                <td name="bstable-actions">
                                    <div class="btn-list">
                                        @if ($edit==true && $editId == $article->id)
                                            <button wire:click='update({{$article->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                                <span class="fe fe-check"> </span>
                                            </button>
                                            <button wire:click='setEdit({{$article->id}})' type="button" class="btn btn-sm btn-primary">
                                                <span class="fe fe-x"> </span>
                                            </button>
                                        @else
                                            <button wire:click='setEdit({{$article->id}})' type="button" class="btn btn-sm btn-primary">
                                                <span class="fe fe-edit"> </span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{$articles->links()}}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-list">
                <button href="javascript:void(0);" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Enregistrer</button>
                <button href="javascript:void(0);" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Enregistrer et imprimer</button>
                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
            </div>
        </div>
    </div>
</div>