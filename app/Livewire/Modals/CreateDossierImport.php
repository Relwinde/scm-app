<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use App\Models\Dossier;
use App\Models\Fournisseur;
use App\Models\Marchandise;
use App\Models\BureauDeDouane;
use LivewireUI\Modal\ModalComponent;

class CreateDossierImport extends ModalComponent
{
    public $num_commande;
    public $client;
    public $fournisseur;
    public $num_facture;
    public $marchandise;
    public $num_dpi;
    public $nombre_colis;
    public $poids;
    public $num_lta;
    public $num_declaration;
    public $valeur_caf;




    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $fournisseurs = Fournisseur::all(['id', 'nom']);
        $marchandises = Marchandise::all(['id', 'nom']);
        $bureau_de_douanes = BureauDeDouane::all(['id', 'nom', 'code']);

        return view('livewire.modals.create-dossier-import', ["clients"=>$clients, "fournisseurs"=>$fournisseurs, "marchandises"=>$marchandises, 'bureau_de_douanes'=>$bureau_de_douanes, "title"=>"Création d'un nouveau dossier d'importation"]);
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
        'num_lta'=>$this->num_lta,
        'num_dpi'=>$this->num_dpi,
        'num_declaration'=>$this->num_declaration,
        'valeur_caf'=>$this->valeur_caf,
        'nombre_colis'=>$this->nombre_colis,
        'poids'=>$this->poids,
        'fournisseur_id'=>$this->fournisseur,
        'bureau_de_douane_id'=>$this->bureau_de_douane,
        'type'=>"IMPORT",
        'user_id'=>1
        ]);

        if(Dossier::latest()->first()==null){

            $numero = "IM"."/".BureauDeDouane::find($this->bureau_de_douane)->code."/".strtoupper(substr($dossier->client->nom, 0, 3))."/".date('Y')."/".'0001';
        }else {
            $numero = "IM"."/".BureauDeDouane::find($this->bureau_de_douane)->code."/".strtoupper(substr($dossier->client->nom, 0, 3))."/".date('Y')."/".str_pad(Dossier::latest()->first()->id+1, 4, '0', STR_PAD_LEFT);
        }

        if($dossier->save()){
            $this->dispatch('new-dossier');
            request()->session()->flash("success", "Dossier ajouté avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");
        }
    }
}
