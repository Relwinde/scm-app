<?php

namespace App\Livewire\Outils;

use App\Models\Vehicule as ModelsVehicule;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class Vehicule extends Component
{

    public $edit = false; 
    public $editId;
    public $immatriculation;
    public $description;
    public $search;

    use WithPagination;

    #[On('new-vehicule')]
    public function render()
    {
        $vehicules = ModelsVehicule::select(['id', 'immatriculation', 'description'])
            ->where('immatriculation', 'like', "%{$this->search}%")
            ->orderBy('created_at', 'DESC')
            ->paginate(10, '*', 'vehicule-pagination');
        return view('livewire.outils.vehicule', ['vehicules'=>$vehicules, 'header_title'=>'Liste des véhicules', 'create_modal'=>'modals.outils.create-vehicule', 'button_title'=>'Nouveau véhicule']);
    }

    public function setEdit (ModelsVehicule $vehicule){
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->edit=true;
            $this->immatriculation = $vehicule->immatriculation;
            $this->description = $vehicule->description;
            $this->editId = $vehicule->id;
        }
    }

    public function update (ModelsVehicule $vehicule){
        $vehicule->immatriculation = $this->immatriculation;
        $vehicule->description = $this->description;
        if($vehicule->save()){
            $this->dispatch('new-vehicule');
            $this->reset();
        }else{
            $this->dispatch('error');
        }
    }
}
