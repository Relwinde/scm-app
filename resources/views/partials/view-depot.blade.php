<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dépot du : <b>{{ $depot->created_at->locale(app()->getLocale())->translatedFormat('j F Y à H:i') }}</b></h3>&nbsp; &nbsp;
        {{-- <div class="card-title">
            @if (Auth::user()->can('Attacher un document à un bon de caisse'))
                <a href="javascript:void(0);" wire:click="$dispatch('openModal', {component: 'modals.bon-de-caisse.attach-file', arguments: { bon : {{ $bon->id }} }})" class="btn btn-primary btn-sm m-1"><i class="icon icon-paper-clip"></i>Attacher une pièce</a>
            @endif
        </div> --}}
    </div>
    <div class="card-header">
        <div class="card-title">
            <a target="_blank"  href="{{route('print-depot', $depot->id)}}" class="btn btn-primary btn-sm m-1">Imprimer le reçu</a>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="text-wrap">
                <div class="example">
                    <p>{{$depot->libelle}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-4 col-md-4 ">
                <div class="card">
                    <div class="card-body">
                        <h4>Montant :</h4>
                        <h1 class="mb-1 number-font" style="font-size: 17px;">{{number_format($depot->montant, 2, '.', ' ')}} F CFA</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-md-4 ">
                <div class="card">
                    <div class="card-body">
                        <h4>Déposant :</h4>
                        <h1 class="mb-1 number-font" style="font-size: 17px;">{{$depot->deposant}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-md-4 ">
                <div class="card">
                    <div class="card-body">
                        <h4>Banque :</h4>
                        <h1 class="mb-1 number-font" style="font-size: 17px;">{{$depot->banque}}</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-md-4 ">
                <div class="card">
                    <div class="card-body">
                        <h4>Référence chèque :</h4>
                        <h1 class="mb-1 number-font" style="font-size: 17px;">{{$depot->ref_cheque}}</h1>
                    </div>
                </div>
            </div>

        <hr>


    </div>

    <div class="card-footer">
        {{-- <div class="row m-2">
            @if (Auth::user()->can('Voir les fichiers joints d\'un bon de caisse') &&   $bon->files->count() > 0)
                <div class="custom-controls-stacked">
                    <label class="custom-control custom-checkbox">
                        <input wire:model.live='viewFiles' type="checkbox" class="custom-control-input">
                        <span class="custom-control-label"> <b>Voir les pièces jointes</b></span>
                    </label>
                </div>

                @if ($viewFiles == true)
                    @foreach ($bon->files as $file)
                        <div class="alert alert-primary" >   
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>{{$file->user->name}}: <br> <a href="{{ asset('storage/app/public/attachments/'.$file->path) }}" target="_blank" >{{$file->name}}</a> <br> <span>{{$file->created_at->locale(app()->getLocale())->translatedFormat('j F Y à H:i:s')}}</span>
                        </div>
                    @endforeach
                @endif
            @endif
        </div> --}}
    </div>
</div>