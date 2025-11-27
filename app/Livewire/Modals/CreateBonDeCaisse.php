<?php

namespace App\Livewire\Modals;

use App\Models\BonDeCaisse;
use App\Models\Dossier;
use App\Models\TransportInterne;
use App\Models\Vehicule;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateBonDeCaisse extends ModalComponent
{
    public $montant;

    public $depense;

    public $dossier;

    public $surDossier = 1;

    public $description;

    public $search;

    public $alert_fm = false;
    public $alert_bae = false;
    public $alert_dex = false;

    public function mount()
    {
        if (auth()->user()->can('Section Transit')) {
            $dossiers_instance_fm = Dossier::getDossiersInStatusOlderThan('fm_prov', 10, auth()->id());
            $this->alert_fm = $dossiers_instance_fm->isNotEmpty();
            $dossiers_instance_dex = Dossier::getDossiersInStatusOlderThan('di_dep', 7, auth()->id());
            $this->alert_dex = $dossiers_instance_dex->isNotEmpty();
        }

        if (auth()->user()->can('Section Logistique')) {
            $dossiers_instance_bae = Dossier::getDossiersInStatusOlderThan('bae', 3, auth()->id());
            $this->alert_bae = $dossiers_instance_bae->isNotEmpty();
        }
    }

    public function render()
    {

        $dossiers = Dossier::where('numero', 'like', '%' . $this->search . '%')->get(['id', 'numero']);
        $transports = TransportInterne::where('numero', 'like', '%' . $this->search . '%')->get(['id', 'numero']);
        $vehicules = Vehicule::where('immatriculation', 'like', '%' . $this->search . '%')->get(['id', 'immatriculation', 'description']);


        return view('livewire.modals.create-bon-de-caisse',['dossiers'=>$dossiers, 'transports'=>$transports, 'vehicules'=>$vehicules, 'title'=>'Création d\'un nouveau bon']);
    }

    public function reformat_montant (){
        $this->montant = number_format(floatval( str_replace(' ', '',$this->montant)), 2, '.', ' ');
    }

    public function create (){
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
            'depense.max'=>'Le type de dépense ne doit pas dépasser 40 caractères',
            'description.string'=>'La description doit être une chaîne de caractères',
        ]);

        switch($this->surDossier){
            case 1:
                 $bon = BonDeCaisse::make([
                    'depense'=> $this->depense,
                    'montant'=> floatval(str_replace(' ', '',$this->montant)),
                    'montant_definitif'=> floatval(str_replace(' ', '',$this->montant)),
                    'dossier_id'=>$this->dossier,
                    'description'=>$this->description,
                    'user_id'=>Auth::user()->id
                 ]);
                break;
            
            case 2:
                $bon = BonDeCaisse::make([
                    'depense'=> $this->depense,
                    'montant'=> floatval(str_replace(' ', '',$this->montant)),
                    'montant_definitif'=> floatval(str_replace(' ', '',$this->montant)),
                    'transport_interne_id'=>$this->dossier,
                    'description'=>$this->description,
                    'user_id'=>Auth::user()->id
                 ]);
                break;

            case 4:
                $bon = BonDeCaisse::make([
                    'depense'=> $this->depense,
                    'montant'=> floatval(str_replace(' ', '',$this->montant)),
                    'montant_definitif'=> floatval(str_replace(' ', '',$this->montant)),
                    'vehicule_id'=>$this->dossier,
                    'description'=>$this->description,
                    'user_id'=>Auth::user()->id
                 ]);
                break;
            case 3:
                $bon = BonDeCaisse::make([
                    'depense'=> $this->depense,
                    'montant'=> floatval(str_replace(' ', '',$this->montant)),
                    'montant_definitif'=> floatval(str_replace(' ', '',$this->montant)),
                    'description'=>$this->description,
                    'user_id'=>Auth::user()->id
                    ]);
                break;
        }

        if(BonDeCaisse::latest()->first()==null){
            $bon->numero= date('Y').date('m').date('d').date('H').date('i').date('s').'0000001';
        }else {
            $bon->numero= date('Y').date('m').date('d').date('H').date('i').date('s').str_pad(BonDeCaisse::latest()->first()->id+1, 7, '0', STR_PAD_LEFT);
        }

        if ($bon->save()){
            $this->dispatch('new-bon-de-caisse');
            $this->reset();
        }else{
            $this->dispatch('error');
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
