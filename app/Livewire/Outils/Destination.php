<?php

namespace App\Livewire\Outils;

use App\Models\Destination as ModelsDestination;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Destination extends Component
{

    public $edit = false; 
    public $editId;
    public $nom;
    public $description;
    public $search;

    use WithPagination;

    #[On('new-destination')]
    public function render()
    {

        $destinations = ModelsDestination::select(['id', 'nom', 'description'])
            ->where('nom', 'like', "%{$this->search}%")
            ->where('description', 'like', "%{$this->search}%")
            ->orderBy('nom', 'ASC')
            ->paginate(10, '*', 'destination-pagination');

        return view('livewire.outils.destination', ['destinations'=>$destinations, 'header_title'=>'Liste des destinations', 'create_modal'=>'modals.outils.create-destination', 'button_title'=>'Nouvelle destination']);
    }

    public function setEdit (ModelsDestination $destination){
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->edit=true;
            $this->nom = $destination->nom;
            $this->description = $destination->description;
            $this->editId = $destination->id;
        }
    }

    public function update (ModelsDestination $destination){
        $destination->nom = $this->nom;
        $destination->description = $this->description;
        if($destination->save()){
            $this->dispatch('new-destination');
            request()->session()->flash("success", "Destination modifié avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
        }
    }
}
