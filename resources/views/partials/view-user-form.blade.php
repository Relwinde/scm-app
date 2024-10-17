@if ($edit==true)
<form wire:submit.prevent="update">
@endif
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}}</b></h3>
            <div class="card-options">
                    <a href="javascript:void(0);" class="btn btn-secondary btn-sm ms-2">Réinitialiser le mot de passe</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nom<span class="required">*</span></label>
                        <input required wire:model='name' type="text" class="form-control" name="user_name" placeholder="Nom d'utilisateur" @if ($edit==false) readonly @endif>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Profile<span class="required">*</span></label>
                        <select required wire:model='profile' name="user_profile" class="form-control custom-select select2" @if ($edit==false) readonly disabled="" @endif>
                            <option value="">Sélectionnez une profile</option>
                            @foreach ($profiles as $profile)
                                <option value="{{$profile->id}}" >{{$profile->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Email<span class="required">*</span></label>
                        <input required wire:model='email' type="text" class="form-control" name="user_email" placeholder="Email" @if ($edit==false) readonly @endif>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            @if ($edit==true)
                <div class="btn-list">
                    @can('Modifier utlisateur')                     
                        <button type="submit" href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
                    @endcan
                    <a href="javascript:void(0);" wire:click='setEdit' class="btn btn-danger">Annuler</a>
                </div>
            @else
                <div class="btn-list">
                    @can('Modifier utlisateur')      
                        <button wire:click='setEdit' href="javascript:void(0);" class="btn btn-primary">Modifier</button>
                    @endcan
                    <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
                </div>
            @endif
        </div>
    </div>

@if ($edit==true)
</form>
@endif

@script
    <script>
        $wire.on('new-user', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Les informations de l'utilisateur ont été mises à jour"
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