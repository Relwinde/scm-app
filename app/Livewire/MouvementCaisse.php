<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SuiviCaisse;
use Livewire\WithPagination;

class MouvementCaisse extends Component
{
    public $start_date;
    public $end_date;

    use WithPagination;

    public function render()
    {
        $query = SuiviCaisse::query();

        if ($this->start_date) {
            $startDate = \Carbon\Carbon::parse($this->start_date)->format('Y-m-d');
            $query->where('created_at', '>=', $startDate);
        }

        if ($this->end_date) {
            $endDate = \Carbon\Carbon::parse($this->end_date)->format('Y-m-d');
            $query->where('created_at', '<=', $endDate);
        }

        $mouvements = $query->orderBy('created_at', 'DESC')->paginate(10, '*', 'mouvement-pagination');


        return view('livewire.mouvement-caisse', ['mouvements' => $mouvements]);
    }
}
