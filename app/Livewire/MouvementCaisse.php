<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SuiviCaisse;
use Livewire\WithPagination;

class MouvementCaisse extends Component
{
    public $start_date;
    public $end_date;
    public $totalSorties;
    public $totalEntrees;

    use WithPagination;

    public function render()
    {
        $query = SuiviCaisse::query();

        if ($this->start_date) {
            $startDate = \Carbon\Carbon::parse($this->start_date)->startOfDay()->format('Y-m-d H:i:s');
            $query->where('suivi_caisses.created_at', '>=', $startDate);
        }
        
        if ($this->end_date) {
            $endDate = \Carbon\Carbon::parse($this->end_date)->endOfDay()->format('Y-m-d H:i:s');
            $query->where('suivi_caisses.created_at', '<=', $endDate);
        }

        
        if ($this->start_date || $this->end_date) {
            // Cloner la requête pour éviter la modification
            $totalDepensesBons = (clone $query)->whereNotNull('suivi_caisses.bon_de_caisse_id')
                                               ->sum('suivi_caisses.montant');
        
            $totalDepensesAjustements = (clone $query)->whereNotNull('suivi_caisses.ajustement_bon_id')
                               ->join('ajustement_bons', 'suivi_caisses.ajustement_bon_id', '=', 'ajustement_bons.id')
                               ->where('ajustement_bons.type', 'EXCEDANT')
                               ->sum('suivi_caisses.montant');
        
            $this->totalSorties = $totalDepensesBons + $totalDepensesAjustements;

            $totalDepots = (clone $query)->whereNotNull('suivi_caisses.depot_id')
                                               ->sum('suivi_caisses.montant');

            $totalRestitutions = (clone $query)->whereNotNull('suivi_caisses.ajustement_bon_id')
                        ->join('ajustement_bons', 'suivi_caisses.ajustement_bon_id', '=', 'ajustement_bons.id')
                        ->where('ajustement_bons.type', 'RESTITUTION')
                        ->sum('suivi_caisses.montant');

            $this->totalEntrees = $totalDepots + $totalRestitutions;
        }
        
        // Utiliser la table 'suivi_caisses' pour éviter l'ambiguïté
        $mouvements = $query->orderBy('suivi_caisses.created_at', 'DESC')->paginate(10, '*', 'mouvement-pagination');
        
        return view('livewire.mouvement-caisse', ['mouvements' => $mouvements]);
    }

    public function resetDates()
    {
        $this->start_date = null;
        $this->end_date = null;
    }

    public function export(){
        $startDate = \Carbon\Carbon::parse($this->start_date)->startOfDay()->format('Y-m-d H:i:s');
        $endDate = \Carbon\Carbon::parse($this->end_date)->endOfDay()->format('Y-m-d H:i:s');
        return (new \App\Exports\MouvementCaisse($startDate, $endDate))->download('mouvement-caisse_du-'.$startDate.'-au-'.$endDate.'.xlsx');
    }
    
}
