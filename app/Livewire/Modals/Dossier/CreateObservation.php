<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use App\Models\Observation;
use LivewireUI\Modal\ModalComponent;

class CreateObservation extends ModalComponent
{


    public Dossier $dossier;

    public $observation;

    public function render()
    {
        return view('livewire.modals.dossier.create-observation', ['title'=>'Nouveau commentaire pour le dossier: ']);
    }

    public function create (){
        Observation::create([
            'content'=>$this->observation,
            'user_id'=>1,
            'dossier_id'=>$this->dossier->id
        ]);

        $this->reset(['observation']);
    }
}
