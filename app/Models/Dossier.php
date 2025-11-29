<?php

namespace App\Models;

use Mpdf\Mpdf;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use Mpdf\WatermarkText;
use App\Models\BonDeCaisse;
use App\Models\Marchandise;
use App\Models\DossierStatus;
use Illuminate\Support\Facades\Auth;
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
        return $this->belongsTo(DossierStatus::class, 'dossier_status_id');
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
            
            $this->refresh();
        }


        // Check if the trasition is non already done
        if ($this->status->code == $statusCode) {
            return;
        }

        $transition = $this->possibleTransitions()
                           ->firstWhere('toStatus.code', $statusCode);

        if (! $transition) {
            throw new \Exception("Transition non permise de {$this->status->code} vers {$statusCode}");
        }

        $from = $this->dossier_status_id;
        $to   = $transition->to_status_id;

        
        DossierStatusHistory::create([
            'dossier_id'     => $this->id,
            'from_status_id' => $from,
            'to_status_id'   => $to,
            'user_id'        => $userId,
        ]);
        $this->update(['dossier_status_id' => $to]);
    }

    public function statusHistories(){
        return $this->hasMany(DossierStatusHistory::class);
    }

    public function daysInCurrentStatus()
    {
        $history = $this->statusHistories()
                        ->where('to_status_id', $this->dossier_status_id)
                        ->latest('created_at')
                        ->first();

        return $history
            ? $history->created_at->diffInDays(now())
            : null;
    }


    public function daysInStatus(string $statusCode)
    {
        $history = $this->statusHistories()
                        ->where('to_status_id', DossierStatus::where('code', $statusCode)->first()->id)
                        ->latest('created_at')
                        ->first();

        return $history
            ? $history->created_at->diffInDays(now())
            : null;
    }

    
    public static function getDossiersInStatusOlderThan(string $statusCode, int $days, int $userId)
    {
        $thresholdDate = now()->subDays($days);

        return self::query()
            ->where('dossier_status_id', DossierStatus::where('code', $statusCode)->first()->id)    
            ->whereHas('statusHistories', function ($q) use ($statusCode, $thresholdDate, $userId) {
                $q->where('to_status_id', DossierStatus::where('code', $statusCode)->first()->id)
                ->where('created_at', '<=', $thresholdDate);

                if ($userId !== null) {
                    $q->where('user_id', $userId);
                }
            })
            ->with('status') // Pour accéder à $dossier->status->name
            ->orderBy('created_at', 'DESC');
    }

    public static function getDossiersInStatusesOlderThan(array $statusCodes, int $days, ?int $userId = null)
    {
        $thresholdDate = now()->subDays($days);

        // Récupérer les IDs des statuts concernés
        $statusIds = DossierStatus::whereIn('code', $statusCodes)->pluck('id');

        return self::query()
            ->whereIn('dossier_status_id', $statusIds)
            ->whereHas('statusHistories', function ($q) use ($statusIds, $thresholdDate, $userId) {
                $q->whereIn('to_status_id', $statusIds)
                ->where('created_at', '<=', $thresholdDate);

                if ($userId !== null) {
                    $q->where('user_id', $userId);
                }
            })
            ->with('status') // Pour accéder à $dossier->status->name
            ->orderBy('created_at', 'DESC');
    }



    public function hasPassedThrough (array $statusCodes): bool {
        $codes = $this->statusHistories()
            ->join('dossier_status', 'dossier_status.id', '=', 'dossier_status_history.to_status_id')
            ->pluck('dossier_status.code')
            ->toArray();

        return collect($statusCodes)->every(fn($code) => in_array($code, $codes));
    }

    public function hasPassedThroughAny (array $statusCodes): bool {
        $codes = $this->statusHistories()
            ->join('dossier_status', 'dossier_status.id', '=', 'dossier_status_history.to_status_id')
            ->pluck('dossier_status.code')
            ->toArray();

        return collect($statusCodes)->contains(fn($code) => in_array($code, $codes));
    }

    public function documents(){
        return $this->hasMany(Document::class);
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

        $partiel = null; 

        if ($this->num_commande != "NA" && $this->num_commande != "na" && $this->num_commande != "NBA" && $this->num_commande != "nba" && Dossier::where('num_commande', $this->num_commande)->count() > 1){
            $partiel = true;
        }

        $html = view('prints.dossier', ['dossier'=>$this, 'partiel'=>$partiel]);
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
        ]);
        $mpdf->SetHTMLFooter('
            <div style="text-align: center; font-size: 10px; opacity: 0.5;">
                <span>Document imprimé le '.date('d/m/Y H:i').'</span>
            </div>
        ');

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
        ]);

        if (! $this->hasPassedThrough(['fm_def'])){
            $mpdf->showWatermarkText = true;
            $mpdf->SetWatermarkText(new WatermarkText('P R O V I S O I R E')); // Will cope with UTF-8 encoded text
            $mpdf->watermarkTextAlpha = 0.09;
        }
        $mpdf->SetHTMLFooter('
            <div style="text-align: center; font-size: 10px; opacity: 0.5;">
                <span>Document imprimé le '.date('d/m/Y H:i').' - par '.auth()->user()->name.'</span>
            </div>
        ');
        $html = view('prints.feuille-minute', ['dossier'=>$this]);
        
        $mpdf->writeHTML($html);
        $mpdf->Output($name = 'Feuille-minute-'.$this->numero.'.pdf', 'I');
    }
}
