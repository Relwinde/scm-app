<?php

namespace App\Livewire\Modals\Outils;

use App\Models\Vehicule;
use LivewireUI\Modal\ModalComponent;

class CreateVehicule extends ModalComponent
{

    public $immatriculation;
    public $description;

    public function render()
    {
        return view('livewire.modals.outils.create-vehicule', ['title'=>"Création d'un nouveau Véhicule"]);
    }

    public function create() {
        $vehicule = Vehicule::make([
            'immatriculation'=>$this->immatriculation,
            'description'=>$this->description
        ]);

        if($vehicule->save()){
            $this->dispatch('new-vehicule');
            $this->reset();
        }else{
            $this->dispatch('error');
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
