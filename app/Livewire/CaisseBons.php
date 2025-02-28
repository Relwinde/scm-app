<?php

namespace App\Livewire;

use App\Models\Depot;
use App\Models\Caisse;
use Livewire\Component;
use App\Models\BonDeCaisse;
use App\Models\SuiviCaisse;
use Livewire\WithPagination;
use App\Models\AjustementBon;
use Illuminate\Support\Facades\Auth;

class CaisseBons extends Component
{

    public $search;

    use WithPagination;

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
        })
        ->where(function ($query) {
            $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                        ->orWhere('bon_de_caisses.etape', 'like', "%{$this->search}%")
                        ->orWhere('bon_de_caisses.depense', 'like', "%{$this->search}%")
                        ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                        ->orWhere('transport_internes.numero', 'like', "%{$this->search}%")
                        ->orWhere('users.name', 'like', "%{$this->search}%")
                        ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%");

        })
        ->orderBy('bon_de_caisses.created_at', 'DESC')
        ->paginate(10, '*', 'bons-pagination');
        
        return view('livewire.caisse-bons', ['bonsDeCaisse' => $bonsDeCaisse]);
    }
}
