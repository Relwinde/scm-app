<?php

namespace App\Livewire\Modals\TransportInterne;

use App\Models\DestinationTransportInterne;
use App\Models\TransportInterne;
use LivewireUI\Modal\ModalComponent;

class ViewItineraires extends ModalComponent
{


    public TransportInterne $dossier;

    public function render()
    {

        $destinations = $this->dossier->destinations;
        return view('livewire.modals.transport-interne.view-itineraires', ['destinations'=>$destinations]);
    }

    public function delete (DestinationTransportInterne $itineraire){
        $itineraire->delete();
    }
    
}
