<table>
    <thead>
        <tr>
            <th><b>Type</b></th>
            <th><b>Libellé</b></th>
            <th><b>Montant</b></th>
            <th><b>Solde avant opération</b></th>
            <th><b>Solde après opération</b></th>
            <th><b>Date</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mouvements as $mouvement)
            <tr >
                <td>
                    @if ($mouvement->bon_de_caisse_id)
                        DEPENSE	
                    @endif
                    @if ($mouvement->depot_id)
                        DEPOT 
                    @endif
                    @if ($mouvement->ajustement_bon)
                        @if ($mouvement->ajustement_bon->type == "RESTITUTION")
                            RESTITUTION
                        @endif
                        @if ($mouvement->ajustement_bon->type == "EXCEDANT")
                            EXCEDANT
                        @endif
                    @endif
                    
                </td>
                <td>
                    @if ($mouvement->bon_de_caisse_id)
                        {{$mouvement->bon_de_caisse->depense}}
                    @endif
                    @if ($mouvement->depot_id)
                        {{$mouvement->depot->libelle}}
                    @endif
                    @if ($mouvement->ajustement_bon)
                        {{$mouvement->ajustement_bon->libelle}}
                    @endif
                </td>
                <td>{{$mouvement->montant}}</td>
                <td>{{$mouvement->solde_before}}</td>
                <td>{{$mouvement->solde_after}}</td>
                <td>{{ $mouvement->created_at->locale(app()->getLocale())->translatedFormat('j F Y à H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>