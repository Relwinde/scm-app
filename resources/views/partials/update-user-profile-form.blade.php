<form wire:submit.prevent="update">
    <div class="card form-input-elements">
        <div class="card-header">
            <h3 class="mb-0 card-title"><b>{{$title}}</b></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="custom-switch">
                            <input type="checkbox" wire:model.live='updatePassword' class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Modifier mon mot de passe</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nom<span class="required">*</span></label>
                        <input required wire:model='name' type="text" class="form-control">
                        @error('name')<div class="error-message"> {{ $message }} </div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Email<span class="required">*</span></label>
                        <input required wire:model='email' type="text" class="form-control">
                        @error('email')<div class="error-message"> {{ $message }} </div>@enderror
                    </div>
                </div>
            </div>
            @if ($updatePassword == true)
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="form-label">Votre mot de passe actuel<span class="required">*</span></label>
                            <input type="password" required wire:model='actualPassword' type="text" class="form-control">
                            @error('actualPassword')<div class="error-message" > {{ $message }} </div>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                                <label class="form-label">Votre nouveau mot de passe<span class="required">*</span></label>
                                <input type="password" required wire:model='password' type="text" class="form-control">
                                @error('password')<div class="error-message"> {{ $message }} </div>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                                <label class="form-label">Confirmez votre nouveau mot de passe<span class="required">*</span></label>
                                <input type="password" required wire:model='password_confirmation' type="text" class="form-control">
                                @error('password_confirmation')<div class="error-message"> {{ $message }} </div>@enderror
                        </div>
                    </div>
                </div>
               
            @endif
            
        </div>
        <div class="card-footer">
            <div class="btn-list">
                <button href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
                <a href="javascript:void(0);" wire:click="$dispatch('closeModal')" class="btn btn-danger">Annuler</a>
            </div>
        </div>
    </div>


</form>