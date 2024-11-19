<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use App\Models\Dossier;
use App\Models\Fournisseur;
use App\Models\Marchandise;
use App\Models\Observation;
use App\Models\NumeroDossier;
use App\Models\BureauDeDouane;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateDossierImport extends ModalComponent
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

        return view('livewire.modals.create-dossier-import', ["clients"=>$clients, "marchandises"=>$marchandises, 'bureau_de_douanes'=>$bureau_de_douanes, "title"=>"Création d'un nouveau dossier d'importation"]);
    }

/**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    // public static function modalMaxWidth(): string
    // {
    //     return 'sm';
    // }
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
        'nombre_colis'=>floatval(str_replace(' ', '',$this->nombre_colis)),
        'poids'=>floatval(str_replace(' ', '',$this->poids)),
        'fournisseur'=>$this->fournisseur,
        'bureau_de_douane_id'=>$this->bureau_de_douane,
        'type'=>"IMPORT",
        'user_id'=>Auth::User()->id
        ]);

        
        if(Dossier::latest()->first()==null){

            $numero = "IM-".BureauDeDouane::find($this->bureau_de_douane)->code."-".strtoupper($dossier->client->code)."/".date('Y').'0001';
        }else{
            $ordre = NumeroDossier::latest()->first()->id+1;

            do {
                $numero = "IM-".BureauDeDouane::find($this->bureau_de_douane)->code."-".strtoupper($dossier->client->code)."/".date('Y').str_pad($ordre, 4, '0', STR_PAD_LEFT);

                $ordre++;
                $pattern = explode('/', $numero)[1];
            } while (NumeroDossier::where('numero', 'LIKE', "%/{$pattern}")->count() > 0);
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

    public function reformat_nombre_colis (){
        $this->nombre_colis = number_format(floatval( str_replace(' ', '',$this->nombre_colis)), 2, '.', ' ');
    }

    public function checkPartial (){
        $partial = Dossier::where('num_commande', $this->num_commande)->where('type', 'IMPORT')->first();

        if($partial != null){
            $this->isPartial = true;
            $this->client = $partial->client_id;
            $this->fournisseur = $partial->fournisseur;
        } else {
            $this->isPartial = false;
            // $this->reset(['client', 'bureau_de_douane']);
        }
    }
}
