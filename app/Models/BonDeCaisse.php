<?php

namespace App\Models;

use Mpdf\Mpdf;
use App\Models\User;
use App\Models\Dossier;
use App\Models\EtapeBon;
use App\Models\AjustementBon;
use App\Models\TransportInterne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BonDeCaisse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function dossier (){
        return $this->belongsTo(Dossier::class, "dossier_id");
    }
    public function transport (){
        return $this->belongsTo(TransportInterne::class, "transport_interne_id");
    }

    public function user (){
        return $this->belongsTo(User::class);
    }

    public function etapes (){
        return $this->hasMany(EtapeBon::class);
    }

    public function ajustements (){
        return $this->hasMany(AjustementBon::class);
    }


    public function print (){
        ini_set('memory_limit', '440M');
        $mpdf = new Mpdf([
            'mode'=>'utf-8',
            'format' => 'A6-L',
            'default_font_size' => 9,
	        'default_font' => 'FreeSerif'
        ]);

        $html = view('prints.bon-de-caisse', ['bon'=>$this]);
        $mpdf->writeHTML($html);
        $mpdf->Output();
    }

}
