<?php

namespace App\Livewire\Modals\Outils;

use App\Models\Destination;
use LivewireUI\Modal\ModalComponent;

class CreateDestination extends ModalComponent
{

    public $nom;
    public $description;

    public function render()
    {
        return view('livewire.modals.outils.create-destination', ['title'=>"Création d'une nouvelle destination"]);
    }

    public function create (){
        $destination = Destination::make([
            'nom'=>$this->nom,
            'description'=>$this->description
        ]);

        if($destination->save()){
            $this->dispatch('new-destination');
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
