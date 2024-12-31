<?php

namespace App\Models;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransportInterne extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function chauffeur(){
        return $this->belongsTo(Chauffeur::class);
    }
    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

    public function destinations (){
        return $this->belongsToMany(Destination::class, 'destination_transport_interne', 'transport_interne_id', 'depart')->withPivot('depart', 'arrivee', 'id')->orderBy('destination_transport_interne.id', 'ASC');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function print (){
        ini_set('memory_limit', '440M');
        
        $mpdf = new Mpdf([
            'mode'=>'utf-8',
            'format' => 'A4-P',
            'default_font_size' => 13,
	        'default_font' => 'FreeSerif'
        ]);

        $html = view('prints.transport-interne', ['dossier'=>$this]);
        $mpdf->writeHTML($html);
        $mpdf->Output();
    }

    public function bon_de_caisse (){
        return $this->hasMany(BonDeCaisse::class);
    }
    
    public function updateNumero (){
        $ordre = NumeroTransport::whereYear('created_at', Carbon::parse($this->created_at)->year)->count() + 1;
        do{
            $numero = "TP04-".strtoupper($this->client->code)."/".Carbon::parse($this->created_at)->year.str_pad($ordre, 4, '0', STR_PAD_LEFT);
            $ordre++; 
            $pattern = explode('/', $numero)[1];
        }
        while(NumeroTransport::where('numero', 'LIKE', "%/{$pattern}")->whereYear('created_at', Carbon::parse($this->created_at)->year)->count() > 0);
        $this->numero = $numero;
    }
    
}
