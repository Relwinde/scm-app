@php
    setlocale(LC_TIME, 'fr_FR.UTF-8');
@endphp

<center style="text-align: center;">
        <p style="font-size: 14; margin-top:-50px;">
            Reçu de bon de caisse N° {{$bon->numero}}
        </p>
</center>
<hr  style="height:2px; color:#0098db; margin :0px;">


<div>
    <p>Emétteur: <b>{{$bon->user->name}}</b></p>
    <p>Dossier: <b>{{$bon->dossier->numero ?? $bon->transport->numero ?? "AUTRES"}}</b></p>
    <p>Intitullé de la dépense: <b>{{$bon->depense}}</b></p>
    <p>Montant: <b>{{number_format($bon->montant_definitif, 2, '.', ' ')}}</b></p>
    <p>Emis le: <b>{{ strftime("%e %B %Y", strtotime($bon->etapes()->where('etape_actuelle', 'RESPONSABLE')->first()->created_at)); }}</b></p>
    <p>Payé le: <b>{{ strftime("%e %B %Y", strtotime($bon->etapes()->where('etape_actuelle', 'PAYE')->first()->created_at)); }}</b></p>

</div>

<div style="width: 100%;  margin-left: auto; margin-right: auto;">
    <table style="width: 100%;  margin-left: auto; margin-right: auto;">
        <tbody>
            <tr>
                <td>
                    La caisse
                </td>
                <td>
                    Le recepteur
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>

                </td>
            </tr>
        </tbody>
    </table>
</div>

