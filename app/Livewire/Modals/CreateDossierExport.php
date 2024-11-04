<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use App\Models\Dossier;
use App\Models\Fournisseur;
use App\Models\Marchandise;
use App\Models\Observation;
use App\Models\BureauDeDouane;
use App\Models\DossierObservation;
use App\Models\NumeroDossier;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateDossierExport extends ModalComponent
{
    public $num_commande;
    public $client;
    public $fournisseur;
    public $num_facture;
    public $marchandise;
    public $num_sylvie;
    public $nombre_colis;
    public $poids;
    public $num_declaration;
    public $valeur_caf;
    public $bureau_de_douane;
    public $observation;
    public $num_exo;
    public $num_lta_bl;
    public $num_t;

    public $isPartial = false;

    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $marchandises = Marchandise::all(['id', 'nom']);
        $bureau_de_douanes = BureauDeDouane::all(['id', 'nom', 'code']);
        
        return view('livewire.modals.create-dossier-export', ["clients"=>$clients,  "marchandises"=>$marchandises, 'bureau_de_douanes'=>$bureau_de_douanes, "title"=>"Création d'un nouveau dossier d'importation"]);
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function create(){

        $dossier=Dossier::make([
        'num_commande'=>$this->num_commande,
        'client_id'=>$this->client,
        'num_facture'=>$this->num_facture,
        'num_sylvie'=>$this->num_sylvie,
        'num_exo'=>$this->num_exo,
        'num_lta_bl'=>$this->num_lta_bl,
        'num_t'=>$this->num_t,
        'num_declaration'=>$this->num_declaration,
        'valeur_caf'=>floatval(str_replace(' ', '',$this->valeur_caf)),
        'nombre_colis'=>$this->nombre_colis,
        'poids'=>floatval(str_replace(' ', '',$this->poids)),
        'fournisseur'=>$this->fournisseur,
        'bureau_de_douane_id'=>$this->bureau_de_douane,
        'type'=>"EXPORT",
        'user_id'=>Auth::User()->id
        ]);

        if($this->isPartial){
            $partialsNumber = Dossier::where('num_commande', $this->num_commande)->where('type', 'EXPORT')->count();
            $firstPartial = Dossier::where('num_commande', $this->num_commande)->where('type', 'EXPORT')->first();
            $numero = $firstPartial->numero."/PO".$partialsNumber;       
        }
        else {
            if(Dossier::latest()->first()==null){
                $numero = "EX".BureauDeDouane::find($this->bureau_de_douane)->code.strtoupper(substr($dossier->client->code, 0, 3))."/".date('Y').'0001';
            }else{
                $numero = "EX".BureauDeDouane::find($this->bureau_de_douane)->code.strtoupper(substr($dossier->client->code, 0, 3))."/".date('Y').str_pad(Dossier::latest()->first()->id+1, 4, '0', STR_PAD_LEFT);
            }
        }


        $dossier->numero = $numero;

        if($dossier->save()){
            if ($this->observation != null && $this->observation != ""){
                Observation::create([
                    'content'=>$this->observation,
                    'user_id'=>1,
                    'dossier_id'=>$dossier->id
                ]);
            }
            $dossier->marchandises()->attach($this->marchandise);

            NumeroDossier::create([
                'dossier_id'=>$dossier->id,
                'numero'=>$dossier->numero
            ]);

            $this->dispatch('new-dossier');
            $this->reset();
        }else{
            $this->dispatch('erreur');
        }
    }

    public function reformat_poids (){
        $this->poids = number_format(floatval( str_replace(' ', '',$this->poids)), 2, '.', ' ');
    }

    public function reformat_valeur_caf (){
        $this->valeur_caf = number_format(floatval( str_replace(' ', '',$this->valeur_caf)), 2, '.', ' ');
    }

    public function checkPartial (){
        $partial = Dossier::where('num_commande', $this->num_commande)->Where('type', 'EXPORT')->first();

        if($partial != null){
            $this->isPartial = true;
            $this->client = $partial->client_id;
            $this->bureau_de_douane = $partial->bureau_de_douane_id;
        } else {
            $this->isPartial = false;
            // $this->reset(['client', 'bureau_de_douane']);
        }
    }
}
