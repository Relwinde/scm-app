<form wire:confirm="Êtes vous sûr de vouloir effectuer ce ajustement, cette action iréversible impactera votre caisse" wire:submit.prevent="create">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="card-title">Bon De: <b>{{$bon->user->name}}</b></h3>&nbsp; &nbsp; 
            <h3 class="card-title">Pour: <b>{{$bon->depense}}</b></h3>&nbsp; &nbsp;
        </div>
        <div class="card-header">
            <h3 class="card-title">Montant actuel: <b>{{ number_format(floatval( str_replace(' ', '',$bon->montant_definitif)), 2, '.', ' ')}} CFA</b></h3>&nbsp; &nbsp;
            <h3 class="card-title">Montant après ajustement: <b>{{ number_format(floatval( str_replace(' ', '',$montantAfter)), 2, '.', ' ')}} CFA</b></h3>&nbsp; &nbsp;
        </div>
        <div class="card-body">
            <div class="row">
                    <div class="mb-4 form-elements">
                        <div class="btn-list">
                            <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                                <input required wire:model.live='type' type="radio" class="custom-control-input" name="type" value="1">
                                <span class="custom-control-label"><b>EXCEDENT</b></span>
                            </label>
                            <label class="custom-control custom-radio" style="display: inline-block; margin:5px;">
                                <input required wire:model.live='type' type="radio" class="custom-control-input" name="type" value="2">
                                <span class="custom-control-label"><b>RESTITUTION</b></span>
                            </label>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Montant<span class="required">*</span></label>
                        <input wire:focusout='reformat_montant()' required wire:model='montant' type="text" class="form-control"  placeholder="Montant">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Libellé<span class="required">*</span></label>
                        <input required wire:model='libelle' type="text" class="form-control"  placeholder="Libellé de l'ajustement">
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
        $wire.on('new-ajustement', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Bon de caisse ajusté"
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

        $wire.on('insufficient-funds', () => {
            (function () {
                $(function () {
                    return $.growl.error({
                        message: "Le montant de la restitution est supérieur au montant actuel du bon de décaissment"
                    });
                });
            }).call(this);
        });
        
    </script>
@endscript