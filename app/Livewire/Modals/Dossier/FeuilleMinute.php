<?php

namespace App\Livewire\Modals\Dossier;

use App\Models\Article;
use App\Models\Dossier;
use LivewireUI\Modal\ModalComponent;

class FeuilleMinute extends ModalComponent
{

    public Dossier $dossier;

    public bool $edit = false;
    public $editId;

    public $name;
    public $code; 
    public $fob_devis;
    public $fob_xof;
    public $fret;
    public $autres_frais;
    public $assurance;
    public $caf;
    public $poids_brut;
    public $poids_net;
    public $quantite_supp;

    public function render()
    {
        $articles = $this->dossier->articles()->paginate(10);
        return view('livewire.modals.dossier.feuille-minute', compact('articles'));
    }

    public function setEdit ($id)
    {
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->editId = $id;
            $this->edit=true;
        }
    }

    public function calculate (){
        $portion = $this->fob_xof / $this->dossier->fob_xof;
        $this->poids_net = $portion * $this->dossier->poids;
        $this->poids_brut = $portion * $this->dossier->poids;
        $this->caf = $portion * $this->dossier->valeur_caf;
        $this->fret = $portion * $this->dossier->fret;
        $this->assurance = $portion * $this->dossier->assurance;
        $this->autres_frais = $portion * $this->dossier->autres_frais;
    }

    public function createArticle (){
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'fob_devis' => 'required|numeric',
            'fob_xof' => 'required|numeric',
            'fret' => 'required|numeric',
            'autres_frais' => 'required|numeric',
            'assurance' => 'required|numeric',
            'caf' => 'required|numeric',
            'poids_brut' => 'required|numeric',
            'poids_net' => 'required|numeric',
            'quantite_supp' => 'required|numeric',
        ],
        [
            'required' => 'Ce champ est requis.',
            'numeric' => 'Ce champ doit être un nombre.',
            'string' => 'Ce champ doit être une chaîne de caractères.',
            'max' => 'Ce champ ne peut pas dépasser :max caractères.',
        ]);

        $this->dossier->articles()->create([
            'name' => $this->name,
            'code' => $this->code,
            'fob_devis' => $this->fob_devis,
            'fob_xof' => $this->fob_xof,
            'fret' => $this->fret,
            'autres_frais' => $this->autres_frais,
            'assurance' => $this->assurance,
            'caf' => $this->caf,
            'poids_brut' => $this->poids_brut,
            'poids_net' => $this->poids_net,
            'quantite_supp' => $this->quantite_supp,
            'user_id' => auth()->id(),
            'dossier_id' => $this->dossier->id
        ]);

        $this->reset(['name', 'code', 'fob_devis', 'fob_xof', 'fret', 'autres_frais', 'assurance', 'caf', 'poids_brut', 'poids_net', 'quantite_supp']);
    }

    public function removeArticle (Article $article){
        $this->dossier->articles()->where('id', $article->id)->delete();
    }
}
