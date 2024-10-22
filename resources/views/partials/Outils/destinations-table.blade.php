<div class="table-responsive">
    <table class="table table-striped table-bordered border text-nowrap mb-0">
        <thead>
            <tr>
                <th class="wd-15p border-bottom-0" style="max-width: 10px"><b></b></th>
                <th class="wd-15p border-bottom-0"><b>Nom</b></th>
                <th class="wd-15p border-bottom-0"><b>Description</b></th>
                <th class="wd-15p border-bottom-0"><b>Actions</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($destinations as $destination)
                <tr wire:key='{{$destination->id}}'>
                    <td style="max-width: 10px">{{$loop->iteration}}</td>
                    <td> @if ($edit==true && $editId == $destination->id)
                        <input wire:model='nom' type="text" class="form-control" name="nom" placeholder="Nom du destination">
                    @else
                        {{$destination->nom}}
                    @endif</td>
                    <td> @if ($edit==true && $editId == $destination->id)
                        <input wire:model='description' type="text" class="form-control" name="description" placeholder="Description du destination">
                    @else
                        {{$destination->description}}
                    @endif</td>
                    <td name="bstable-actions">
                        <div class="btn-list">
                            @if ($edit==true && $editId == $destination->id)
                                <button wire:click='update({{$destination->id}})' href="javascript:void(0);" class="btn btn-sm btn-primary">
                                    <span class="fe fe-check"> </span>
                                </button>
                                <button wire:click='setEdit({{$destination->id}})' type="button" class="btn btn-sm btn-primary">
                                    <span class="fe fe-x"> </span>
                                </button>
                            @else
                                <button wire:click='setEdit({{$destination->id}})' type="button" class="btn btn-sm btn-primary">
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
        {{$destinations->links()}}
    </div>
</div>