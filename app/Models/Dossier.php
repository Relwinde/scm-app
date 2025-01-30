<?php

namespace App\Models;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\BonDeCaisse;
use App\Models\Marchandise;
use Illuminate\Database\Eloquent\Model;
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

    public function print (){
        ini_set('memory_limit', '440M');
        
        $mpdf = new Mpdf([
            'mode'=>'utf-8',
            'format' => 'A4-P',
            'default_font_size' => 14,
	        'default_font' => 'FreeSerif'
        ]);

        $html = view('prints.dossier', ['dossier'=>$this]);
        $mpdf->writeHTML($html);
        $mpdf->Output($name = 'Dossier-'.$this->numero.'.pdf', 'I');
    }

    public function bon_de_caisse (){
        return $this->hasMany(BonDeCaisse::class);
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

}
