<?php

namespace App\Livewire\Outils;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Chauffeur as ModelsChauffeur;

class Chauffeur extends Component
{

    public $edit = false; 
    public $editId;
    public $nom;
    public $contact;
    public $search;

    use WithPagination;

    #[On('new-chauffeur')]
    public function render()
    {
        $chauffeurs = ModelsChauffeur::select(['id', 'nom', 'contact'])
        ->where('nom', 'like', "%{$this->search}%")
        ->where('contact', 'like', "%{$this->search}%")
        ->orderBy('nom', 'ASC')
        ->paginate(10, '*', 'dossier-pagination');
        
        $this->resetPage();

        return view('livewire.outils.chauffeur',['chauffeurs'=>$chauffeurs, 'header_title'=>'Liste des chauffeurs', 'create_modal'=>'modals.outils.create-chauffeur']);
    }

    public function setEdit (ModelsChauffeur $chauffeur){
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

    public function update (ModelsChauffeur $chauffeur){
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
