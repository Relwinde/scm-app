<?php

namespace App\Models;

use Mpdf\Mpdf;
use App\Models\User;
use App\Models\Client;
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

}
