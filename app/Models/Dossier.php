<?php

namespace App\Models;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\BonDeCaisse;
use App\Models\Marchandise;
use App\Models\DossierStatus;
use Illuminate\Database\Eloquent\Model;
use App\Models\DossierStatusTransaction;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dossier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];


    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class);
    }

    public function marchandises(){
        return $this->belongsToMany(Marchandise::class);
    }

    public function bureau_de_douane(){
        return $this->belongsTo(BureauDeDouane::class);
    }

    public function observations(){
        return $this->hasMany(Observation::class);
        
    }

    public function status()
    {
        return $this->belongsTo(DossierStatus::class);
    }

    public function possibleTransitions()
    {
        return DossierStatusTransaction::where('from_status_id', $this->dossier_status_id)
                         ->with('toStatus')
                         ->get();
    }

    public function canTransitionTo(string $statusCode): bool
    {
        return $this->possibleTransitions()
            ->pluck('toStatus.code')
            ->contains($statusCode);
    }

    public function transitionTo(string $statusCode, $userId)
    {

        if ($this->status == null){
            $this->update(['dossier_status_id' => DossierStatus::where('code', 'ssi')->first()->id]);
        }

        $transition = $this->possibleTransitions()
                           ->firstWhere('toStatus.code', $statusCode);

        if (! $transition) {
            throw new \Exception("Transition non permise de {$this->status->code} vers {$statusCode}");
        }

        $from = $this->dossier_status_id;
        $to   = $transition->to_status_id;

        $this->update(['dossier_status_id' => $to]);

        DossierStatusHistory::create([
            'dossier_id'     => $this->id,
            'from_status_id' => $from,
            'to_status_id'   => $to,
            'user_id'        => $userId,
        ]);
    }

    public function delivery_slip(){
        return $this->hasOne(DeliverySlip::class);
    }



    public function print (){
        ini_set('memory_limit', '440M');
        
        $mpdf = new Mpdf([
            'mode'=>'utf-8',
            'format' => 'A4-P',
            'default_font_size' => 14,
	        'default_font' => 'FreeSerif',
            'margin_left' => 5,
            'margin_right' => 5,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
        ]);

        $html = view('prints.dossier', ['dossier'=>$this]);
        $mpdf->writeHTML($html);
        $mpdf->Output($name = 'Dossier-'.$this->numero.'.pdf', 'I');
    }

    public function bon_de_caisse (){
        return $this->hasMany(BonDeCaisse::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function updateNumero (){
        switch($this->type){
            case "IMPORT": 
                $ordre = NumeroDossier::whereYear('created_at', Carbon::parse($this->created_at)->year)->count() + 1;
                do {
                    $numero = "IM-".BureauDeDouane::find($this->bureau_de_douane_id)->code."-".strtoupper($this->client->code)."/".Carbon::parse($this->created_at)->year.str_pad($ordre, 4, '0', STR_PAD_LEFT);
                    $ordre++;
                    $pattern = explode('/', $numero)[1];
                } while (NumeroDossier::where('numero', 'LIKE', "%/{$pattern}")->count() > 0);
                 
                $this->numero = $numero;
                break;

            case "EXPORT": 
                $ordre = NumeroDossier::whereYear('created_at', Carbon::parse($this->created_at)->year)->count() + 1;
                do {
                    $numero = "EX-".BureauDeDouane::find($this->bureau_de_douane_id)->code."-".strtoupper($this->client->code)."/".Carbon::parse($this->created_at)->year.str_pad($ordre, 4, '0', STR_PAD_LEFT);
                    $ordre++;
                    $pattern = explode('/', $numero)[1];
                } while (NumeroDossier::where('numero', 'LIKE', "%/{$pattern}")->count() > 0);

                $this->numero = $numero;
                break;
            
            default;
        }

    }

    public function print_delivery_slip (){
        ini_set('memory_limit', '440M');
        $mpdf = new Mpdf([
            'mode'=>'utf-8',
            'format' => 'A4-L',
            'default_font_size' => 14,
            'default_font' => 'FreeSerif',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 0,
            'margin_footer' => 0,
        ]);

        $html = view('prints.delivery-slip', ['dossier'=>$this]);
        $mpdf->writeHTML($html);
        $mpdf->Output($name = 'Bon-de-livraison-'.$this->numero.'.pdf', 'I');
    }

    public function print_feuille_minute (){
        ini_set('memory_limit', '440M');
        $mpdf = new Mpdf([
            'mode'=>'utf-8',
            'format' => 'A4-L',
            'default_font_size' => 14,
            'default_font' => 'FreeSerif',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 0,
            'margin_footer' => 0,
        ]);

        $html = view('prints.feuille-minute', ['dossier'=>$this]);
        $mpdf->writeHTML($html);
        $mpdf->Output($name = 'Feuille-minute-'.$this->numero.'.pdf', 'I');
    }

}
