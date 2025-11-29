<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use Livewire\WithPagination;
use App\Models\TransportInterne;
use LivewireUI\Modal\ModalComponent;

class ViewAlertDossiers extends ModalComponent
{
    public $statut;
    public $search = '';

    public $name;

    use WithPagination;

    public function mount(string $statut){
        $this->statut = $statut;
    }

    public function render()
    {
        $transports = null;

        if ($this->statut === 'fm') {
            $this->name = 'ayant des feuilles minutes à mettre à jour';

            $dossiers = Dossier::getDossiersInStatusesOlderThan(
                ['fm_prov', 'fm_def'],
                10,
                auth()->id()
            )
            ->paginate(10, ['*'], 'dossier-pagination');; 
        
        } elseif ($this->statut === 'bae') {
            $this->name = 'en attente de livraison';
            $dossiers = Dossier::getDossiersInStatusOlderThan('bae', 3, auth()->id());

            $transports = TransportInterne::getDossiersInStatusOlderThan('ecl', 3, auth()->id());

        } elseif ($this->statut === 'dex') {
            $this->name = "en attente de la reponse à la demande d'exonération";
            $dossiers = Dossier::getDossiersInStatusOlderThan('di_dep', 3, auth()->id());
        }

        return view('livewire.modals.dossier.view-alert-dossiers', ['dossiers'=>$dossiers, 'transports'=>$transports]);
    }
}
