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
                            <th class="wd-15p border-bottom-0 text-nowrap"><b>Nomenc</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>FOB XOF</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>FOB Devise</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>Fret</b></th>
                            <th class="wd-20p border-bottom-0"><b>A frais</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>Assu</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b>CAF</b></th>
                            <th class="wd-20p border-bottom-0"><b>P brut</b></th>
                            <th class="wd-20p border-bottom-0"><b>P net</b></th>
                            <th class="wd-20p border-bottom-0"><b>Q supp</b></th>
                            <th class="wd-20p border-bottom-0"><b>Orig</b></th>
                            <th class="wd-20p border-bottom-0 text-nowrap"><b></b></th>
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
                                    <input wire:model='fob_xof' type="number" class="form-control" name="fob_xof" placeholder="FOB XOF" wire:focusout="calculate">
                                    @error('fob_xof')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='fob_devis' type="number" class="form-control" name="fob_devis" placeholder="FOB Devise" wire:focusout="calculate">
                                    @error('fob_devis')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='fret' type="number" class="form-control" name="fret" placeholder="Fret">
                                    @error('fret')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='autres_frais' type="number" class="form-control" name="autres_frais" placeholder="Autres frais">
                                    @error('autres_frais')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='assurance' type="number" class="form-control" name="assurance" placeholder="Assurance">
                                    @error('assurance')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='caf' type="number" class="form-control" name="caf" placeholder="CAF">
                                    @error('caf')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='poids_brut' type="number" class="form-control" name="poids_brut" placeholder="Poids brut">
                                    @error('poids_brut')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='poids_net' type="number" class="form-control" name="poids_net" placeholder="Poids net">
                                    @error('poids_net')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='quantite_supp' type="number" class="form-control" name="quantite_supp" placeholder="Quantité supplémentaire">
                                    @error('quantite_supp')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap">
                                    <input wire:model='origin' type="text" class="form-control" name="origin" placeholder="Origine">
                                    @error('origin')<div class="error-message"> {{ $message }} </div>@enderror
                                </td>
                                <td class="text-nowrap" style="width: 1%;">
                                    <button wire:click="createArticle" class="btn btn-primary">+</button>
                                </td>
                            </tr>
                        </form>
                        
                        @foreach ($articles as $article)
                            <tr style="font-weight:600;" wire:key='{{$article->id}}'>
                                <td class="text-nowrap">
                                  {{$loop->iteration}}  
                               </td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="name" id="name" wire:model="edit_name">
                                @else
                                  {{$article->name}}  
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="code" id="code" wire:model="edit_code">
                                @else
                                  {{$article->code}}  
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="fob_xof" id="fob_xof" wire:model="edit_fob_xof">
                                @else
                                  {{$article->fob_xof}}  
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="fob_devis" id="fob_devis" wire:model="edit_fob_devis">
                                @else
                                  {{$article->fob_devis}}  
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="fret" id="fret" wire:model="edit_fret">
                                @else
                                  {{$article->fret}}  
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="autres_frais" id="autres_frais" wire:model="edit_autres_frais">
                                @else
                                  {{$article->autres_frais}}  
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="assurance" id="assurance" wire:model="edit_assurance">
                                @else
                                  {{$article->assurance}}  
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="caf" id="caf" wire:model="edit_caf">
                                @else
                                  {{$article->caf}}   
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="poids_brut" id="poids_brut" wire:model="edit_poids_brut">
                                @else
                                  {{$article->poids_brut}}
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="poids_net" id="poids_net" wire:model="edit_poids_net">
                                @else
                                  {{$article->poids_net}}  
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="number" name="quantite_supp" id="quantite_supp" wire:model="edit_quantite_supp">
                                @else
                                  {{$article->quantite_supp}}  
                                @endif</td>
                                <td class="text-nowrap">@if ($edit==true && $editId == $article->id)
                                    <input type="text" name="origin" id="origin" wire:model="edit_origin">
                                @else
                                  {{$article->origin}}  
                                @endif</td>
                                <td name="bstable-actions">
                                    <div class="btn-list">
                                        @if ($edit == true && $editId == $article->id)
                                            <button wire:click='update({{$article->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                                <span class="fe fe-check"> </span>
                                            </button>
                                            <a wire:click='setEdit({{$article->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                                <span class="fe fe-x"> </span>
                                            </a>
                                        @else
                                            <a wire:click='setEdit({{$article->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                                <span class="fe fe-edit"> </span>
                                            </a>
                                            <button wire:click='removeArticle({{$article->id}})' wire:confirm= "Êtes-vous sûr de vouloir supprimer cet article ?" href="javascript:void(0);" class="btn btn-sm btn-danger">
                                                <span class="fe fe-trash"></span>
                                            </a>
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
                @if ($articles->count() > 0)
                    <a target="_blank"  href="{{route('print-feuille-minute', $dossier->id)}}" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Imprimer</a>
                @endif
                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Fermer</a>
                <a href="javascript:void(0);" wire:click="setFeuilleMinute" wire:confirm= "Êtes-vous sûr de vouloir confirmer la feuille minute ? Cette action est irréversible." class="btn btn-outline-danger">Confirmer la feuille minute</a>
            </div>
        </div>
    </div>
</div>