<?php

namespace App\Livewire\Outils;

use App\Models\Marchandise as ModelsMarchandise;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Marchandise extends Component
{

    public $edit = false; 
    public $editId;
    public $nom;
    public $search;

    use WithPagination;
    
    #[On('new-marchandise')]
    public function render()
    {
        $marchandises = ModelsMarchandise::select(['id', 'nom'])
            ->where('nom', 'like', "%{$this->search}%")
            ->orderBy('created_at', 'DESC')
            ->paginate(10, '*', 'marchandise-pagination');
        return view('livewire.outils.marchandise', ['marchandises'=>$marchandises, 'header_title'=>'Liste des marchandises', 'create_modal'=>'modals.outils.create-marchandise', 'button_title'=>'Nouvelle marchandise']);
    }

    public function setEdit (ModelsMarchandise $marchandise){
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->edit=true;
            $this->nom = $marchandise->nom;
            $this->editId = $marchandise->id;
        }
    }

    public function update (ModelsMarchandise $marchandise){
        $marchandise->nom = $this->nom;
        if($marchandise->save()){
            $this->dispatch('new-marchandise');
            request()->session()->flash("success", "Marchandise modifié avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
        }
    }
}
