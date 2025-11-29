<?php

namespace App\Livewire\Modals\TransportInterne;

use App\Models\Dossier;
use App\Models\BonDeCaisse;
use App\Models\TransportInterne;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Modals\BonDeCaisse\ViewBon;

class CreateBon extends ModalComponent
{

    public TransportInterne $dossier;

    public $montant;

    public $depense;

    public $description;

    public $alert_fm = false;
    public $alert_bae = false;
    public $alert_dex = false;

    public function mount()
    {
        if (auth()->user()->can('Section Transit')) {
            $dossiers_instance_fm = Dossier::getDossiersInStatusOlderThan('fm_prov', 10, auth()->id())->count();

            $dossiers_instance_fm += Dossier::getDossiersInStatusOlderThan('fm_def', 10, auth()->id())->count();  

            $this->alert_fm = $dossiers_instance_fm > 5;
            $dossiers_instance_dex = Dossier::getDossiersInStatusOlderThan('di_dep', 3, auth()->id())->count();
            $this->alert_dex = $dossiers_instance_dex > 0;
        }

        if (auth()->user()->can('Section Logistique')) {
            $dossiers_instance_bae = Dossier::getDossiersInStatusOlderThan('bae', 3, auth()->id())->count();

            $dossiers_instance_bae += TransportInterne::getDossiersInStatusOlderThan('ecl', 3, auth()->id())->count();
            $this->alert_bae = $dossiers_instance_bae > 3;

        }
    }

    public function render()
    {
        return view('livewire.modals.transport-interne.create-bon', ['title'=>'Nouveau bon sur le dossier:']);
    }

    public function reformat_montant (){
        $this->montant = number_format(floatval( str_replace(' ', '',$this->montant)), 2, '.', ' ');
    }

    public function createBon(){

        $this->montant = str_replace(' ', '',$this->montant);
        $this->validate([
            'montant'=>'required|numeric|min:1',
            'depense'=>'required|string|max:40',
            'description'=>'nullable|string',
        ],
        [
            'montant.required'=>'Le montant est obligatoire',
            'montant.numeric'=>'Le montant doit être un nombre',
            'montant.min'=>'Le montant doit être supérieur ou égal à 1',
            'depense.required'=>'Le type de dépense est obligatoire',
            'depense.string'=>'Le type de dépense doit être une chaîne de caractères',
            'depense.max'=>'L\'intitulé la de dépense ne doit pas dépasser 40 caractères',
            'description.string'=>'La description doit être une chaîne de caractères',
        ]);

        $bon = BonDeCaisse::make([
            'depense'=> $this->depense,
            'montant'=> floatval(str_replace(' ', '',$this->montant)),
            'montant_definitif'=> floatval(str_replace(' ', '',$this->montant)),
            'transport_interne_id'=>$this->dossier->id,
            'description'=>$this->description,
            'user_id'=>Auth::user()->id
         ]);

         if(BonDeCaisse::latest()->first()==null){
            $bon->numero= date('Y').date('m').date('d').date('H').date('i').date('s').'0000001';
        }else {
            $bon->numero= date('Y').date('m').date('d').date('H').date('i').date('s').str_pad(BonDeCaisse::latest()->first()->id+1, 7, '0', STR_PAD_LEFT);
        }

        if ($bon->save()){
            $this->dispatch('new-bon-de-caisse');
            $this->reset(['montant', 'depense', 'description']);
        }else{
            $this->dispatch('error');
        }
    }
}