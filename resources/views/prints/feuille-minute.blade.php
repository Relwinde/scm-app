@php
    setlocale(LC_TIME, 'fr_FR.UTF-8');
@endphp

<style>
    
    #info table, #info th, #info td {
        border: 1px solid white;
        border-collapse: collapse;
        border-radius: 5px;
        background-color: #f4effd;
        padding: 5px;
        margin: 5px;
    }

    #table table, #table th, #table td {
        border: 2px solid #f4effd;
        border-collapse: collapse;
        border-radius: 5px;
        padding: 5px;
        margin: 5px;
    }
    
</style>

<center style="text-align: center;">
    <h1 style="font-size: 20; font-weight: bold;">FEUILLE MINUTE - {{$dossier->numero}}</h1>
</center>

<hr style="height:3px; color:#0098db;">
<div id="info" style="width: 100%; text-align: center;">
    <table style="width: 100%; font-size: 16px;">
        <thead>
        </thead>
        <tbody>
            <tr>
                <td style="width: auto;"><h4>Exportateur&nbsp;&nbsp;: </h4></td>
                <td ><h>{{$dossier->fournisseur}}</h></td>
                <td style="width: auto;"><h4>P/B/KG&nbsp;&nbsp;: </h4></td>
                <td ><h>{{number_format($dossier->articles->sum('poids_brut'), 2, '.', ' ')}}</h></td>
                <td style="width: auto;"><h4>FOB XOF&nbsp;&nbsp;: </h4></td>
                <td ><h>{{number_format($dossier->fob_xof, 2, '.', ' ')}}</h></td>
            </tr>
            <tr>
                <td style="width: auto;"><h4>Pays de provenance&nbsp;&nbsp;: </h4></td>
                <td ><h>{{$dossier->origine}}</h></td>
                <td style="width: auto;"><h4>P/N/KG&nbsp;&nbsp;: </h4></td>
                <td ><h>{{number_format($dossier->articles->sum('poids_net'), 2, '.', ' ')}}</h></td>
                <td style="width: auto;"><h4>FOB DEVISE&nbsp;&nbsp;: </h4></td>
                <td ><h>{{number_format($dossier->fob_devis, 2, '.', ' ')}}</h></td>
            </tr>
            <tr>
                <td style="width: auto;"><h4>Destinataire&nbsp;&nbsp;: </h4></td>
                <td ><h>{{$dossier->client->nom}}</h></td>
                <td style="width: auto;"><h4>Nombre de colis&nbsp;&nbsp;: </h4></td>
                <td ><h>{{$dossier->nombre_colis}}</h></td>
                <td style="width: auto;"><h4>Fret&nbsp;&nbsp;: </h4></td>
                <td ><h>{{number_format($dossier->fret, 2, '.', ' ')}}</h></td>
            </tr>
            <tr>
                <td style="width: auto;"><h4>N° IFU&nbsp;&nbsp;: </h4></td>
                <td ><h>{{$dossier->client->ifu}}</h></td>
                <td style="width: auto;"><h4>Sommier&nbsp;&nbsp;: </h4></td>
                <td ><h>{{$dossier->num_t}}</h></td>
                <td style="width: auto;"><h4>Assurance&nbsp;&nbsp;: </h4></td>
                <td ><h>{{number_format($dossier->assurance, 2, '.', ' ')}}</h></td>
            </tr>
            <tr>
                <td style="width: auto;"><h4>Bureau de douane&nbsp;&nbsp;: </h4></td>
                <td ><h>{{$dossier->bureau_de_douane->nom}}</h></td>
                <td style="width: auto;"><h4>CAF&nbsp;&nbsp;: </h4></td>
                <td ><h>{{number_format($dossier->valeur_caf, 2, '.', ' ')}}</h></td>
                <td style="width: auto;"><h4>Autres frais&nbsp;&nbsp;: </h4></td>
                <td ><h>{{number_format($dossier->autre_frais, 2, '.', ' ')}}</h></td>
            </tr>
        </tbody>
    </table>
</div>

<div id="table" style="width: 100%; text-align: center; margin-top: 50px;">
    <table style="width: 100%; font-size: 16px;">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Nomenc</th>
                <th>FOB XOF</th>
                <th>FOB Devise</th>
                <th>Fret</th>
                <th>Assu</th>
                <th>A frais</th>
                <th>CAF</th>
                <th>P brut</th>
                <th>P net</th>
                <th>Q supp</th>
                <th>Orig</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dossier->articles()->orderBy('created_at', 'desc')->get() as $article)
                <tr>
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->code }}</td>
                    <td>{{ number_format($article->fob_xof, 2, '.', ' ') }}</td>
                    <td>{{ number_format($article->fob_devis, 2, '.', ' ') }}</td>
                    <td>{{ number_format($article->fret, 2, '.', ' ') }}</td>
                    <td>{{ number_format($article->assurance, 2, '.', ' ') }}</td>
                    <td>{{ number_format($article->autres_frais, 2, '.', ' ') }}</td>
                    <td>{{ number_format($article->caf, 2, '.', ' ') }}</td>
                    <td>{{ number_format($article->poids_brut, 2, '.', ' ') }}</td>
                    <td>{{ number_format($article->poids_net, 2, '.', ' ') }}</td>
                    <td>{{ number_format($article->quantite_supp, 2, '.', ' ') }}</td>
                    <td>{{ $article->origin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


