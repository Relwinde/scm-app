<?php

namespace App\Livewire;

use App\Models\AjustementBon;
use Carbon\Carbon;
use App\Models\Depot;
use Livewire\Component;
use App\Models\BonDeCaisse;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Caisse as ModelsCaisse;
use App\Models\SuiviCaisse;

class Caisse extends Component
{

    public $search;

    use WithPagination;
    public function render()
    {
        

        $bonsDeCaisse = BonDeCaisse::select([
            'bon_de_caisses.id',
            'bon_de_caisses.numero',
            'bon_de_caisses.montant_definitif',
            'bon_de_caisses.depense',
            'bon_de_caisses.etape',
            'bon_de_caisses.rejected',
            'bon_de_caisses.dossier_id',
            'transport_interne_id',
            'bon_de_caisses.user_id',
            'bon_de_caisses.created_at'
        ])
        ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
        ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
        ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
        ->where(function ($query) {
            $query->where('bon_de_caisses.etape', 'CAISSE')
                    ->orWhere('bon_de_caisses.etape', 'PAYE');
        })
        ->where(function ($query) {
            $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                        ->orWhere('bon_de_caisses.etape', 'like', "%{$this->search}%")
                        ->orWhere('bon_de_caisses.depense', 'like', "%{$this->search}%")
                        ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                        ->orWhere('transport_internes.numero', 'like', "%{$this->search}%")
                        ->orWhere('users.name', 'like', "%{$this->search}%");
        })
        ->orderBy('bon_de_caisses.created_at', 'DESC')
        ->paginate(10, '*', 'bons-pagination');
        
        $sommeAttente= BonDeCaisse::where('bon_de_caisses.etape', 'CAISSE')->sum('montant');

        $solde = ModelsCaisse::find(1)->solde;
        
        $sommeDepots = Depot::whereDate('depots.created_at', Carbon::today())->sum('montant') + AjustementBon::where('ajustement_bons.type', 'RESTITUTION')->whereDate('ajustement_bons.created_at', Carbon::today())
        ->sum('montant');

        $sommeDecaissements = SuiviCaisse::whereNotNull('suivi_caisses.bon_de_caisse_id')
        ->whereDate('suivi_caisses.created_at', Carbon::today())
        ->sum('montant') + AjustementBon::where('ajustement_bons.type', 'EXCEDANT')->whereDate('ajustement_bons.created_at', Carbon::today())
        ->sum('montant');

        return view('livewire.caisse', ['header_title'=>'Opérations de caisse', 'bonsDeCaisse' => $bonsDeCaisse, 'sommeAttente'=>$sommeAttente, 'sommeDepots'=>$sommeDepots, 'sommeDecaissements'=>$sommeDecaissements, 'solde'=>$solde]);
    }
}
