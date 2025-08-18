<form wire:submit.prevent="create" >
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Client<span class="required">*</span></label>
                        <select @if ($isPartial) readonly disabled="" @endif required wire:model='client' name="client" class="form-control">
                            <option value="">Sélectionnez un client</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}" >{{$client->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de Commande<span class="required">*</span></label>
                        <input wire:focusout='checkPartial' required wire:model='num_commande' type="text" class="form-control" placeholder="N° de Commande">
                        @if ($isPartial)
                            <div class="error-message">Bon de commande trouvé: ce dossier sera un partiel</div>
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Fournisseur<span class="required">*</span></label>
                        <input @if ($isPartial) readonly disabled="" @endif required wire:model='fournisseur' type="text" class="form-control" placeholder="Fournisseur" name="fournisseur">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de Facture</label>
                        <input wire:model='num_facture' type="text" class="form-control" placeholder="N° de Facture" name="num_facture">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Nature du colis<span class="required">*</span></label>
                        <select required wire:model='marchandise' class="form-control">
                            <option value="">Sélectionnez une marchandise</option>
                            @foreach ($marchandises as $marchandise)
                                <option value="{{$marchandise->id}}" >{{$marchandise->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° SYLVIE</label>
                        <input wire:model='num_sylvie' type="text" class="form-control" placeholder="N° SYLVIE" name="num_sylvie">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de décision EXO</label>
                        <input wire:model='num_exo' type="text" class="form-control" placeholder="N° de décision EXO" name="num_exo">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nombre de colis</label>
                        <input wire:focusout='reformat_nombre_colis()' wire:model='nombre_colis' type="text" class="form-control" placeholder="Nombre de colis" name="nombre_colis">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Bureau de douane<span class="required">*</span></label>
                        <select required wire:model='bureau_de_douane' name="bureau_de_douane" class="form-control custom-select select2">
                            <option value="" >Selectionnez un bureau de douane</option>
                            @foreach ($bureau_de_douanes as $bureau_de_douane)
                                <option value="{{$bureau_de_douane->id}}" >{{$bureau_de_douane->nom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° BL/LTA</label>
                        <input wire:model='num_lta_bl' type="text" class="form-control" placeholder="N° BL/LTA" name="num_lta_bl">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Poids (KG)<span class="required">*</span></label>
                        <input required wire:focusout='reformat_poids()' wire:model='poids' type="text" class="form-control" placeholder="Poids" name="poids">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">N° de déclaration</label>
                        <input wire:model='num_declaration' type="text" class="form-control" placeholder="N° de déclaration" name="num_declaration">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Valeur CAF</label>
                        <input wire:focusout='reformat_valeur_caf()' wire:model='valeur_caf' type="text" class="form-control" placeholder="Valeur CAF" name="valeur_caf">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Numéro de T1</label>
                        <input wire:model='num_t' type="text" class="form-control" placeholder="N° de T1" name="num_t">
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="mb-0">
                        <label class="form-label">Commentaire</label>
                        <textarea wire:model='observation' class="form-control" rows="2" placeholder="Votre commentaire ici.."></textarea>
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

@script
    <script>
        $wire.on('new-dossier', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Le dossier a été créé"
                    });
                });
            }).call(this);
        });

        $wire.on('error', () => {
            (function () {
                $(function () {
                    return $.growl.warning({
                        message: "Une erreur est survenue"
                    });
                });
            }).call(this);
        });
    </script>
@endscript
