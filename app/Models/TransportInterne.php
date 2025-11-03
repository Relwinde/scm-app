<?php

namespace App\Models;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\DeliverySlip;
use App\Models\TransportStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TransportStatusHistory;

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
            'default_font_size' => 14,
	        'default_font' => 'FreeSerif'
        ]);

        $html = view('prints.transport-interne', ['dossier'=>$this]);
        $mpdf->writeHTML($html);
        $mpdf->Output($name = 'Transport-'.$this->numero.'.pdf', 'I');
    }

    public function bon_de_caisse (){
        return $this->hasMany(BonDeCaisse::class);
    }

    public function marchandises(){
        return $this->belongsToMany(Marchandise::class);
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

    public function status (){
        return $this->belongsTo(TransportStatus::class, 'transport_status_id');
    }

    public function possibleTransitions (){
        return TransportStatusTransaction::where('from_status_id', $this->transport_status_id)
                                            ->with('toStatus')
                                            ->get();
    }

    public function canTransitionTo(string $statusCode)
    {
        $possibleTransitions = $this->possibleTransitions()
                                    ->pluck('toStatus.code')
                                    ->contains($statusCode);
    }


    public function transitionTo (string $statusCode, $userId){

        if ($this->status == null){
            $this->update(['transport_status_id' => TransportStatus::where('code', 'ssi')->first()->id]);

            $this->refresh();
        }

        if ($this->status->code == $statusCode){
            return;
        }

        $transition = $this->possibleTransitions ()
                        ->firstWhere('toStatus.code', $statusCode); 

        
        if (! $transition) {
            throw new \Exception("Transition non permise de {$this->status->code} vers {$statusCode}");
        }   

        $from = $this->transport_status_id;
        $to   = $transition->to_status_id;

        TransportStatusHistory::create([
            'transport_interne_id' => $this->id,
            'from_status_id' => $from, 
            'to_status_id' => $to, 
            'user_id' => $userId,
        ]);

        $this->update(['transport_status_id' => $to]);

    }

    public function statusHistories()
    {
        return $this->hasMany(TransportStatusHistory::class);
    }

    public function hasPassedThrough(array $statusCodes)
    {
        $codes = $this->statusHistories()
                    ->join('transport_statuses', 'transport_statuses.id', '=', 'transport_status_histories.to_status_id')
                    ->pluck('transport_statuses.code')
                    ->toArray();

        return collect($statusCodes)->every(fn($code) => in_array($code, $codes));
    }

    public function hasPassedThroughAny (array $statusCodes){
        $codes = $this->statusHistories()
                        ->join('transport_statuses', 'transport_statuses.id', '=', 'transport_status_histories.to_status_id')
                        ->pluck('transport_statuses.code')
                        ->toArray();

        return collect($statusCodes)->contains(fn($code) => in_array($code, $codes));
        
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }


    public function delivery_slip (){
        return $this->hasOne(DeliverySlip::class);
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
    
}
