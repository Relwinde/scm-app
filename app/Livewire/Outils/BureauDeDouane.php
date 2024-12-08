<?php

namespace App\Livewire\Outils;

use App\Models\BureauDeDouane as ModelsBureauDeDouane;
use Livewire\Component;
use Livewire\Attributes\On;

class BureauDeDouane extends Component
{

    public $edit = false; 
    public $editId;
    public $nom;
    public $code;
    public $search;

    #[On('new-bureau-de-douane')]
    public function render()
    {
        $bureaux = ModelsBureauDeDouane::select(['id', 'nom', 'code'])
            ->where('nom', 'like', "%{$this->search}%")
            ->orWhere('code', 'like', "%{$this->search}%")
            ->orderBy('nom', 'ASC')
            ->paginate(10, '*', 'bureau-pagination');

        return view('livewire.outils.bureau-de-douane',['bureaux'=>$bureaux, 'header_title'=>'Liste des bureaux de douane', 'create_modal'=>'modals.outils.create-bureau-de-douane', 'button_title'=>'Nouveau bureau']);
    }

    public function setEdit (ModelsBureauDeDouane $bureau){
        if($this->edit == true){
            $this->edit=false;
        }else{
            $this->edit=true;
            $this->nom = $bureau->nom;
            $this->code = $bureau->code;
            $this->editId = $bureau->id;
        }
    }

    public function update (ModelsBureauDeDouane $bureau){
        $bureau->nom = $this->nom;
        $bureau->code = $this->code;
        if($bureau->save()){
            $this->dispatch('new-bureau-de-douane');
            request()->session()->flash("success", "Bureau de douane modifié avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
        }
    }
}
