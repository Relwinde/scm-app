<form wire:submit.prevent="create">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                    <div class="mb-4 form-elements">
                        <div class="btn-list">
                            <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                                <input wire:model.live='surDossier' type="radio" class="custom-control-input" name="example-radios" value="1">
                                <span class="custom-control-label"><b>IMPORT / EXPORT</b></span>
                            </label>
                            <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                                <input wire:model.live='surDossier' type="radio" class="custom-control-input" name="example-radios" value="2">
                                <span class="custom-control-label"><b>TRANSPORT INTERNE</b></span>
                            </label>
                            <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                                <input wire:model.live='surDossier' type="radio" class="custom-control-input" name="example-radios" value="3">
                                <span class="custom-control-label"><b>Autres</b></span>
                            </label>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    @if ($surDossier == 1 || $surDossier == 2)
                        <div class="mb-4">
                            <label class="form-label">Numéro de dossier</label>
                            <select required wire:model='dossier' name="user_profile" class="form-control custom-select select2">
                                <option value="">Sélectionnez un dossier</option>

                                @if ($surDossier == 1)
                                    @foreach ($dossiers as $dossier)
                                        <option value="{{$dossier->id}}" >{{$dossier->numero}}</option>
                                    @endforeach  
                                @elseif ($surDossier == 2)
                                    @foreach ($transports as $transport)
                                        <option value="{{$transport->id}}" >{{$transport->numero}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <label class="form-label">Montant</label>
                        <input wire:focusout='reformat_montant()' required wire:model='montant' type="text" class="form-control"  placeholder="Montant">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Dépense engagée</label>
                        <input required wire:model='depense' type="text" class="form-control"  placeholder="Dépense engagée">
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-list">
                <button href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
            </div>
        </div>
    </div>


</form>