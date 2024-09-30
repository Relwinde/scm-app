<div class="table-responsive">
    <table class="table table-bordered border text-nowrap mb-0">
        <thead>
            <tr>
                <th class="wd-15p border-bottom-0" style="max-width: 10px"><b></b></th>
                <th class="wd-15p border-bottom-0"><b>Nom</b></th>
                <th class="wd-15p border-bottom-0"><b>Code</b></th>
                <th class="wd-15p border-bottom-0"><b>Actions</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bureaux as $bureau)
                <tr wire:key='{{$bureau->id}}'>
                    <td style="max-width: 10px">{{$loop->iteration}}</td>
                    <td> @if ($edit==true && $editId == $bureau->id)
                        <input wire:model='nom' type="text" class="form-control" name="nom" placeholder="Nom du bureau">
                    @else
                        {{$bureau->nom}}
                    @endif</td>
                    <td> @if ($edit==true && $editId == $bureau->id)
                        <input wire:model='code' type="text" class="form-control" name="code" placeholder="Code du bureau de douane">
                    @else
                        {{$bureau->code}}
                    @endif</td>
                    <td name="bstable-actions">
                        <div class="btn-list">
                            @if ($edit==true && $editId == $bureau->id)
                                <button wire:click='update({{$bureau->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                    <span class="fe fe-check"> </span>
                                </button>
                                <button wire:click='setEdit({{$bureau->id}})' type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-x"> </span>
                                </button>
                            @else
                                <button wire:click='setEdit({{$bureau->id}})' type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-edit"> </span>
                                </button>
                            @endif
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{$bureaux->links()}}
    </div>
</div>