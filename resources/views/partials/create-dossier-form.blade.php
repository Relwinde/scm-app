<form wire:submit.prevent="create" >
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Client</label>
                        <select required wire:model='client' name="client" class="form-control custom-select select2">
                            <option value="">Sélectionnez un client</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}" >{{$client->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de Commande</label>
                        <input wire:model='num_commande' type="text" class="form-control" name="example-text-input" placeholder="N° de Commande">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Fournisseur</label>
                        <input wire:model='fournisseur' type="text" class="form-control" name="example-text-input" placeholder="Fournisseur">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de Facture</label>
                        <input wire:model='num_facture' type="text" class="form-control" name="example-text-input" placeholder="N° de Facture">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Nature du colis</label>
                        <select wire:model='marchandise' name="country" id="select-countries" class="form-control custom-select select2">
                            <option value="">Sélectionnez une marchandise</option>
                            @foreach ($marchandises as $marchandise)
                                <option value="{{$marchandise->id}}" >{{$marchandise->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° SYLVIE</label>
                        <input wire:model='num_sylvie' type="text" class="form-control" name="example-text-input" placeholder="N° SYLVIE">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de décision EXO</label>
                        <input wire:model='num_exo' type="text" class="form-control" name="example-text-input" placeholder="N° de décision EXO">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° BL/LTA</label>
                        <input wire:model='num_lta_bl' type="text" class="form-control" name="example-text-input" placeholder="N° de décision EXO">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nombre de colis</label>
                        <input wire:model='nombre_colis' type="number" class="form-control" name="example-text-input" placeholder="Nombre de colis">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Bureau de douane</label>
                        <select required wire:model='bureau_de_douane' name="bureau_de_douane" class="form-control custom-select select2">
                            <option value="" >Bureau de douane</option>
                            @foreach ($bureau_de_douanes as $bureau_de_douane)
                                <option value="{{$bureau_de_douane->id}}" >{{$bureau_de_douane->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Poids</label>
                        <input wire:model='poids' type="number" class="form-control" name="example-text-input" placeholder="Poids">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° LTA</label>
                        <input wire:model='num_lta' type="text" class="form-control" name="example-text-input" placeholder="N° LTA">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de déclaration</label>
                        <input wire:model='num_declaration' type="text" class="form-control" name="example-text-input" placeholder="N° de déclaration">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Valeur CAF</label>
                        <input wire:model='valeur_caf' type="number" class="form-control" name="example-text-input" placeholder="N° CAF">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Numéro de T1</label>
                        <input wire:model='num_t' type="text" class="form-control" name="example-text-input" placeholder="N° de T1">
                    </div>
                    <div class="mb-6">
                        <div class="row">
                            <div class="col-md-8">
                                <label class="form-label">Valeur de la marchandise</label>
                                <input wire:model='valeur_marchandise' type="number" step="0.001" class="form-control" name="example-text-input" placeholder="Valeur de la marchandise">
                            </div>
                            <div class="col-md-4">     
                                <label class="form-label">Devise</label>
                                <input wire:model='devise' type="text" step="0.001" class="form-control" name="example-text-input" placeholder="Devise de la valeur de la marchandise">
                            </div>
                        </div>
        
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="mb-0">
                        <label class="form-label">Commentaire</label>
                        <textarea wire:model='observation' class="form-control" name="example-textarea-input" rows="2" placeholder="text here.."></textarea>
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
