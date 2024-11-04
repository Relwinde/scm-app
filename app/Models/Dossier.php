<?php

namespace App\Models;

use Mpdf\Mpdf;
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
            'default_font_size' => 9,
	        'default_font' => 'FreeSerif'
        ]);

        $html = view('prints.dossier', ['dossier'=>$this]);
        $mpdf->writeHTML($html);
        $mpdf->Output();
    }

    public function bon_de_caisse (){
        return $this->hasMany(BonDeCaisse::class);
    }

    public function updateNumero (){
        switch($this->type){
            case "IMPORT": 
                $this->numero = "IM".BureauDeDouane::find($this->bureau_de_douane_id)->code.strtoupper(substr($this->client->code, 0, 3))."/".date('Y').str_pad(Dossier::latest()->first()->id+1, 4, '0', STR_PAD_LEFT);
                break;

            case "EXPORT": 
                $this->numero = "EX".BureauDeDouane::find($this->bureau_de_douane_id)->code.strtoupper(substr($this->client->code, 0, 3))."/".date('Y').str_pad(Dossier::latest()->first()->id+1, 4, '0', STR_PAD_LEFT);
                break;
            
            default;
        }

    }

}
