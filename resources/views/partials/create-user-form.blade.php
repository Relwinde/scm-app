<form wire:submit.prevent="create">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nom<span class="required">*</span></label>
                        <input required wire:model='nom' type="text" class="form-control" name="user_name" placeholder="Nom d'utilisateur">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Profile<span class="required">*</span></label>
                        <select required wire:model='profile' name="user_profile" class="form-control custom-select select2">
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
                        <input required wire:model='email' type="text" class="form-control" name="user_email" placeholder="Email">
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
        $wire.on('new-user', () => {
            (function () {
                $(function () {
                    return $.growl({
                        title: "Succès :",
                        message: "Nouveau utilisateur créé"
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