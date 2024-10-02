<?php

namespace App\Livewire\Modals\Outils;

use App\Models\Vehicule;
use LivewireUI\Modal\ModalComponent;

class CreateVehicule extends ModalComponent
{

    public $immatriculation;

    public function render()
    {
        return view('livewire.modals.outils.create-vehicule', ['title'=>"Création d'un nouveau Véhicule"]);
    }

    public function create() {
        $vehicule = Vehicule::make([
            'immatriculation'=>$this->immatriculation
        ]);

        if($vehicule->save()){
            $this->dispatch('new-vehicule');
            request()->session()->flash("success", "Véhicule ajouté avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");

        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
