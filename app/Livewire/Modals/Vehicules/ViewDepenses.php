<?php

namespace App\Livewire\Modals\Vehicules;

use App\Models\Vehicule;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;
use PHPUnit\Framework\Attributes\Depends;

class ViewDepenses extends ModalComponent
{

    public Vehicule $vehicule;
    public $search;
    #[Validate('date')]
    public $start_date;

    #[Validate('date')]
    public $end_date;


    use WithPagination;

    public function render()
    {
        
        $query = $this->vehicule->bonDeCaisses()
            ->join('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->where(function ($query) {
                $query->where('bon_de_caisses.etape', 'PAYE')
                        ->orWhere('bon_de_caisses.etape', 'CLOS');
            })
            ->where(function ($query) {
                $query->where('depense', 'like', "%{$this->search}%")
                    ->orWhere('numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%");
            })
            ->orderBy('bon_de_caisses.created_at', 'DESC')
            ->paginate(10, '*', 'depenses-pagination');

            if ($this->start_date) {
                $query->where('bon_de_caisses.created_at', '>=', $this->start_date);    
            }
            
            if ($this->end_date) {
                $query->where('bon_de_caisses.created_at', '<=', $this->end_date);
            }

            $depenses = $query;

        return view('livewire.modals.vehicules.view-depenses', ['depenses' => $depenses]);
    }
}
