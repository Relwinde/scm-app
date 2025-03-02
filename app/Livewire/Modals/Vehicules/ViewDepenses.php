<?php

namespace App\Livewire\Modals\Vehicules;

use App\Models\BonDeCaisse;
use App\Models\Vehicule;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;
use PHPUnit\Framework\Attributes\Depends;

class ViewDepenses extends ModalComponent
{

    public Vehicule $vehicule;
    public $search;

   
    public $start_date;

    public $total_depenses;

    public $end_date;


    use WithPagination;

    public function render()
    {
        
        $query = BonDeCaisse::with('user')
                    ->where('vehicule_id', $this->vehicule->id)
                    ->where(function ($query) {
                        $query->where('bon_de_caisses.etape', 'PAYE')
                            ->orWhere('bon_de_caisses.etape', 'CLOS');
                    })
                    ->where(function ($query) {
                        $query->where('depense', 'like', "%{$this->search}%")
                            ->orWhere('numero', 'like', "%{$this->search}%")
                            ->OrWhereHas('user', function ($query) {
                                $query->where('name', 'like', "%{$this->search}%");
                            });
                    });
    

                if ($this->start_date) {
                    $startDate = \Carbon\Carbon::parse($this->start_date)->format('Y-m-d');
                    $query->where('bon_de_caisses.created_at', '>=', $startDate);  
                }
                
                if ($this->end_date) {
                    $endDate = \Carbon\Carbon::parse($this->end_date)->format('Y-m-d');
                    $query->where('bon_de_caisses.created_at', '<=', $endDate);
                }

        if($this->start_date || $this->end_date){
            $this->total_depenses = $query->sum('montant_definitif');
        }

        $depenses = $query->orderBy('bon_de_caisses.created_at', 'DESC')
        ->paginate(10);


        return view('livewire.modals.vehicules.view-depenses', ['bonsDeCaisse' => $depenses]);
    }
}
