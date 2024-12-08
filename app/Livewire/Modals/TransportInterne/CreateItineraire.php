<?php

namespace App\Livewire\Modals\TransportInterne;

use App\Models\Destination;
use App\Models\DestinationTransportInterne;
use App\Models\TransportInterne;
use LivewireUI\Modal\ModalComponent;

class CreateItineraire extends ModalComponent
{

    public TransportInterne $dossier;
    public $depart;
    public $arrivee;

    public function render()
    {

        $destinations = Destination::all(['id', 'nom']);
        return view('livewire.modals.transport-interne.create-itineraire', ['title'=> "Nouveau itinéraire pour le dossier: ", 'destinations'=>$destinations]);
    }

    public function create (){

        DestinationTransportInterne::create([
            'transport_interne_id' => $this->dossier->id,
            'depart' => $this->depart,
            'arrivee' => $this->arrivee
        ]);

        $this->reset(['depart', 'arrivee']);

    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
