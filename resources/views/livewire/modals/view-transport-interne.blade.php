<div>
    <div class="row " >
        {{-- <div class="col-md-6 col-lg-6"> --}}
            {{-- @include('partials.create-dossier-form') --}}
            @if ($edit==true)
            <form wire:submit.prevent="update" >
            @endif
                <div class="card form-input-elements">
                    <div class="card-header">
                        <h3 class="mb-0 card-title"><b>Détails du dossier</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Client</label>
                                    <select wire:model='client' name="client" class="form-control custom-select select2">
                                        <option  @if ($edit==false) readonly disabled="" @endif value="" >Sélectionnez un client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{$client->id}}" >{{$client->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Chauffeur</label>
                                    <select  @if ($edit==false) readonly disabled="" @endif wire:model='chauffeur' name="country" id="select-countries" class="form-control custom-select select2">
                                        <option value="" >Sélectionnez un chauffeur</option>
                                        @foreach ($chauffeurs as $chauffeur)
                                            <option value="{{$chauffeur->id}}" >{{$chauffeur->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Véhicule</label>
                                    <select  @if ($edit==false) readonly disabled="" @endif wire:model='vehicule' name="country" id="select-countries" class="form-control custom-select select2">
                                        <option value="" >Sélectionnez un véhicule</option>
                                        @foreach ($vehicules as $vehicule)
                                            <option value="{{$vehicule->id}}" >{{$vehicule->immatriculation}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Montant</label>
                                    <input  @if ($edit==false) readonly disabled="" @endif wire:model='montant' type="number" class="form-control" name="example-text-input" placeholder="Montant">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Type de transport</label>
                                    <select  @if ($edit==false) readonly disabled="" @endif wire:model='type_transport' name="country" id="select-countries" class="form-control custom-select select2">
                                        <option value="" >Sélectionnez le type de transport</option>
                                        <option value="04" >Transport routier</option>
                                        <option value="03" >Transport maritime</option>
                                        <option value="02" >Transport aérien</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                {{-- <div class="mb-0">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" name="example-textarea-input" rows="4" placeholder="text here.."></textarea>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if ($edit==true)
                            <div class="btn-list">
                                <button type="submit" href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
                                <a href="javascript:void(0);" wire:click='setEdit' class="btn btn-danger">Annuler</a>
                            </div>
                        @else
                            <div class="btn-list">
                                <button wire:click='setEdit' href="javascript:void(0);" class="btn btn-primary">Modifier</button>
                                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        {{-- </div> --}}
    </div>
</div>
