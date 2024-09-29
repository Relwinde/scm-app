<?php

namespace App\Livewire\Outils;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Chauffeur as Chauffeurs;

class Chauffeur extends Component
{

    public $edit = false; 
    public $editId;
    public $nom;
    public $contact;

    #[On('new-chauffeur')]
    public function render()
    {
        $chauffeurs = Chauffeurs::all(['id', 'nom', 'contact']);
        return view('livewire.outils.chauffeur',['chauffeurs'=>$chauffeurs, 'header_title'=>'Dossier d\'importation', 'create_modal'=>'modals.outils.create-chauffeur']);
    }

    public function setEdit (Chauffeurs $chauffeur){
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->edit=true;
            $this->nom = $chauffeur->nom;
            $this->contact = $chauffeur->contact;
            $this->editId = $chauffeur->id;
        }
    }

    public function update (Chauffeurs $chauffeur){
        $chauffeur->nom = $this->nom;
        $chauffeur->contact = $this->contact;
        if($chauffeur->save()){
            $this->dispatch('new-chauffeur');
            request()->session()->flash("success", "Chauffeur modifié avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
        }
    }

}
