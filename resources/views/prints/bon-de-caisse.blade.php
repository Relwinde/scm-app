@php
    use Carbon\Carbon;

    setlocale(LC_TIME, 'fr_FR.UTF-8');

    $date = Carbon::now();

    setlocale(LC_TIME, 'fr_FR.UTF-8');

    $formattedDate = $date->translatedFormat('l d F Y \à H\h i\m s\s');

@endphp

<style>
    td{
        padding: 10px;
    }
</style>

<center style="text-align: center;">
        <p style="font-size: 14; margin-top:-150px;">
            Reçu de bon de caisse N° {{$bon->numero}}
        </p>
</center>
<hr  style="height:2px; color:#0098db; margin :0px;">


<div>
    <table>
        <tbody>
            <tr>
                <td>
                    <p>Emétteur: <b>{{$bon->user->name}}</b></p>
                </td>
                <td>
                    <p>Dossier: <b>{{$bon->dossier->numero ?? $bon->transport->numero ?? "AUTRES"}}</b></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Intitullé de la dépense: <b>{{$bon->depense}}</b></p>
                </td>
                <td>
                    <p>Montant: <b>{{number_format($bon->montant_definitif, 2, '.', ' ')}} CFA</b></p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Emis le: <b>{{ strftime("%e %B %Y", strtotime($bon->etapes()->where('etape_actuelle', 'RESPONSABLE')->first()->created_at)); }}</b></p>
                </td>
                <td>
                    <p>Payé le: <b>{{ strftime("%e %B %Y", strtotime($bon->etapes()->where('etape_actuelle', 'PAYE')->first()->created_at)); }}</b></p>
                </td>
            </tr>
            <tr>
                <td>
                    La caisse
                </td>
                <td>
                    Le recepteur
                </td>
            </tr>
        </tbody>
    </table>


</div>


<center style="text-align: center;">
    <p style="font-size: 10; margin-top:20px;">
            Reçu imprimé le {{$formattedDate}}
     </p>
</center>

