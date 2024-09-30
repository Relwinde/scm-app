<?php

namespace App\Livewire;

use App\Models\Dossier;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\TransportInterne;

class TransportsInternes extends Component
{
    public $search;

    use WithPagination;

    #[On('new-dossier')]
    public function render()
    {
        $dossiers = TransportInterne::where('numero', 'like', "%{$this->search}%")
        ->orderBy('created_at', 'DESC')
        ->paginate(20, '*', 'dossier-pagination');
        return view('livewire.transports-internes', [
            'dossiers' => $dossiers, 'header_title'=>'Dossiers de transports internes', 'create_modal'=>'modals.create-transport-interne'
        ]);
    }
}
