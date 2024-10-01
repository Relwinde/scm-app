<?php

namespace App\Livewire\Outils;

use App\Models\Fournisseur as ModelsFournisseur;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Fournisseur extends Component
{

    public $edit = false; 
    public $editId;
    public $nom;
    public $email;
    public $telephone;
    public $adresse;

    public $search;

    use WithPagination;

    #[On('new-fournisseur')]
    public function render()
    {
        $fournisseurs = ModelsFournisseur::select(['id', 'email', 'nom', 'telephone', 'adresse'])
            ->where('nom', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->orWhere('telephone', 'like', "%{$this->search}%")
            ->orWhere('adresse', 'like', "%{$this->search}%")
            ->orderBy('nom', 'ASC')
            ->paginate(10, '*', 'fournisseur-pagination');
            
        return view('livewire.outils.fournisseur',['fournisseurs'=>$fournisseurs, 'header_title'=>'Liste des fournisseurs', 'create_modal'=>'modals.outils.create-fournisseur', 'button_title'=>'Nouveau fournisseur']);
    }

    public function setEdit (ModelsFournisseur $fournisseur){
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->edit=true;
            $this->nom = $fournisseur->nom;
            $this->email = $fournisseur->email;
            $this->telephone = $fournisseur->telephone;
            $this->adresse = $fournisseur->adresse;
            $this->editId = $fournisseur->id;
        }
    }

    public function update (ModelsFournisseur $fournisseur){
        $fournisseur->nom = $this->nom;
        $fournisseur->email = $this->email;
        $fournisseur->telephone = $this->telephone;
        $fournisseur->adresse = $this->adresse;
        if($fournisseur->save()){
            $this->dispatch('new-fournisseur');
            request()->session()->flash("success", "Fournisseur modifié avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
        }
    }

}
