<div>
    <div class="row " >
        {{-- <div class="col-md-6 col-lg-6"> --}}
            {{-- @include('partials.create-dossier-form') --}}
            <form wire:submit.prevent="create" >
                <div class="card form-input-elements">
                    <div class="card-header">
                        <h3 class="mb-0 card-title">Création d'un nouveau dossier {{$title}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label">Client</label>
                                    <select wire:model='client' name="client" class="form-control custom-select select2">
                                        <option value="" >Sélectionnez un client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{$client->id}}" >{{$client->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Chauffeur</label>
                                    <select wire:model='chauffeur' name="country" id="select-countries" class="form-control custom-select select2">
                                        <option value="" >Sélectionnez un chauffeur</option>
                                        @foreach ($chauffeurs as $chauffeur)
                                            <option value="{{$chauffeur->id}}" >{{$chauffeur->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Véhicule</label>
                                    <select wire:model='vehicule' name="country" id="select-countries" class="form-control custom-select select2">
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
                                    <input wire:model='montant' type="number" class="form-control" name="example-text-input" placeholder="Montant">
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
                        {{-- <div class="btn-list">
                            <button href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
                            <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
                        </div> --}}
                    </div>
                </div>
            </form>
        {{-- </div> --}}
    </div>
</div>
