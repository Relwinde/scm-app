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

    public $pick = 0;
    public $start_bon_rows;
    public $actual_bon_rows;

    use WithPagination;

    public function mount(){
        $bonsDeCaisse = BonDeCaisse::select([
            'bon_de_caisses.id',
            'bon_de_caisses.numero',
            'bon_de_caisses.montant_definitif',
            'bon_de_caisses.depense',
            'bon_de_caisses.etape',
            'bon_de_caisses.type_paiement',
            'bon_de_caisses.rejected',
            'bon_de_caisses.dossier_id',
            'bon_de_caisses.vehicule_id',
            'bon_de_caisses.transport_interne_id',
            'bon_de_caisses.user_id',
            'bon_de_caisses.created_at'
        ])
        ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
        ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
        ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
        ->leftjoin('vehicules', 'bon_de_caisses.vehicule_id', '=', 'vehicules.id')
        ->where(function ($query) {
            $query->where('bon_de_caisses.etape', 'CAISSE')
                    ->orWhere('bon_de_caisses.etape', 'PAYE')
                    ->orWhere('bon_de_caisses.etape', 'CLOS');
        });

        $this->start_bon_rows = $bonsDeCaisse->count();
    }

    public function render()
    {
        if (! Auth::user()->can('Voir l\'état de la caisse')){
            redirect("/");
        }

        $bonsDeCaisse = BonDeCaisse::select([
            'bon_de_caisses.id',
            'bon_de_caisses.numero',
            'bon_de_caisses.montant_definitif',
            'bon_de_caisses.depense',
            'bon_de_caisses.etape',
            'bon_de_caisses.type_paiement',
            'bon_de_caisses.rejected',
            'bon_de_caisses.dossier_id',
            'bon_de_caisses.vehicule_id',
            'bon_de_caisses.transport_interne_id',
            'bon_de_caisses.user_id',
            'bon_de_caisses.created_at'
        ])
        ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
        ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
        ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
        ->leftjoin('vehicules', 'bon_de_caisses.vehicule_id', '=', 'vehicules.id')
        ->where(function ($query) {
            $query->where('bon_de_caisses.etape', 'CAISSE')
                    ->orWhere('bon_de_caisses.etape', 'PAYE')
                    ->orWhere('bon_de_caisses.etape', 'CLOS');
        });

        $this->actual_bon_rows = $bonsDeCaisse->count();

        $sommeAttente= BonDeCaisse::where('bon_de_caisses.etape', 'CAISSE')->where('type_paiement', 'ESPECE')->sum('montant');

        $solde = ModelsCaisse::find(1)->solde;
        
        $sommeDepots = Depot::whereDate('depots.created_at', Carbon::today())->sum('montant') + AjustementBon::where('ajustement_bons.type', 'RESTITUTION')->whereDate('ajustement_bons.created_at', Carbon::today())
        ->sum('montant');

        $sommeDecaissements = SuiviCaisse::whereNotNull('suivi_caisses.bon_de_caisse_id')
        ->whereDate('suivi_caisses.created_at', Carbon::today())
        ->sum('montant') + AjustementBon::where('ajustement_bons.type', 'EXCEDANT')->whereDate('ajustement_bons.created_at', Carbon::today())
        ->sum('montant');

        return view('livewire.caisse', ['header_title'=>'Opérations de caisse', 'sommeAttente'=>$sommeAttente, 'sommeDepots'=>$sommeDepots, 'sommeDecaissements'=>$sommeDecaissements, 'solde'=>$solde]);
    }

    public function notificate(){
        if ($this->start_bon_rows != $this->actual_bon_rows){
            $this->dispatch('notification');
            $this->start_bon_rows = $this->actual_bon_rows;
        }
    }

}
