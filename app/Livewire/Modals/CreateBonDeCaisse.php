<?php

namespace App\Livewire\Modals;

use App\Models\BonDeCaisse;
use App\Models\Dossier;
use App\Models\TransportInterne;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateBonDeCaisse extends ModalComponent
{
    public $montant;

    public $depense;

    public $dossier;

    public $surDossier = 1;

    public $description;

    public function render()
    {

        $dossiers = Dossier::all(['id', 'numero']);
        $transports = TransportInterne::all(['id', 'numero']);


        return view('livewire.modals.create-bon-de-caisse',['dossiers'=>$dossiers, 'transports'=>$transports, 'title'=>'Création d\'un nouveau bon']);
    }

    public function reformat_montant (){
        $this->montant = number_format(floatval( str_replace(' ', '',$this->montant)), 2, '.', ' ');
    }

    public function create (){

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
