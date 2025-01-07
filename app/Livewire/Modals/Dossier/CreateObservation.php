<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Dossier;
use App\Models\Observation;
use Illuminate\Support\Facades\Auth;
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
            'user_id'=>Auth::user()->id,
            'dossier_id'=>$this->dossier->id
        ]);

        $this->reset(['observation']);
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
