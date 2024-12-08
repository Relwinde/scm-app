@php
    use App\Models\Destination;  
@endphp



<div class="col-sm-12 col-md-12">
    <div class="card">
        <div class="card-header justify-content-between">
            <h3 class="card-title"> <b>Itinéraire du dossier {{$dossier->numero}}</b></h3>

            <a wire:click="$dispatch('closeModal')" href="javascript:void(0);" class="btn btn-outline-primary">Retour</a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered border text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th class="wd-15p border-bottom-0" style="max-width: 10px"><b></b></th>
                            <th class="wd-15p border-bottom-0"><b>Lieu de départ</b></th>
                            <th class="wd-15p border-bottom-0"><b>Lieu d'arrivée</b></th>
                            <th class="wd-15p border-bottom-0"><b>Actions</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($destinations as $destination)
                            <tr wire:key='{{$destination->id}}'>
                                <td style="max-width: 10px">{{$loop->iteration}}</td>
                                <td>@php
                                    echo Destination::find($destination->pivot->depart)->nom;
                                @endphp</td>
                                <td>@php
                                    echo Destination::find($destination->pivot->arrivee)->nom;
                                @endphp</td>
                                <td name="bstable-actions">
                                    <div class="btn-list">
                                            <button wire:click='delete({{$destination->pivot->id}})' type="button" class="btn btn-sm btn-danger">
                                                <span class="fe fe-x-circle"> </span>
                                            </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>