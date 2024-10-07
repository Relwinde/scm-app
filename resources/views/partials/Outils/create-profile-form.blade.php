<form action="">

    <div class="row">
        <div class="col-md-6">
            <div class="mb-4">
                <label class="form-label">Nom</label>
                <input required  type="text" class="form-control" name="nom" placeholder="Nom de la destination">
            </div>
        </div>
        <div wire:ignore class="col-md-6">
            <div class="mb-4">
                <label class="form-label">Permissions</label>
                <select name="permissions[]" multiple>
                    <option value="AL">Alabama</option>
                    <option value="WY">Wyoming</option>
                    <option value="WY">Wyoming</option>
                    <option value="WY">Wyoming</option>
                    <option value="WY">Wyoming</option>
                    <option value="WY">Wyoming</option>
                    <option value="WY">Wyoming</option>
                </select>
            </div>
        </div>
        <div class="btn-list">
            <button href="javascript:void(0);" class="btn btn-primary">Enregistrer</button>
            <a href="javascript:void(0);"class="btn btn-danger">Annuler</a>
        </div>
        <div class="col-md-12 ">
            {{-- <div class="mb-0">
                <label class="form-label">Message</label>
                <textarea class="form-control" name="example-textarea-input" rows="4" placeholder="text here.."></textarea>
            </div> --}}
        </div>
    </div>

</form>