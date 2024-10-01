<?php

namespace App\Livewire\Modals;

use App\Models\BureauDeDouane;
use App\Models\Client;
use App\Models\Dossier;
use LivewireUI\Modal\ModalComponent;
use App\Models\Fournisseur;
use App\Models\Marchandise;

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
    public $num_lta;
    public $num_declaration;
    public $valeur_caf;
    public $bureau_de_douane;

    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $fournisseurs = Fournisseur::all(['id', 'nom']);
        $marchandises = Marchandise::all(['id', 'nom']);
        $bureau_de_douanes = BureauDeDouane::all(['id', 'nom', 'code']);
        return view('livewire.modals.create-dossier-export', ["clients"=>$clients, "fournisseurs"=>$fournisseurs, "marchandises"=>$marchandises, 'bureau_de_douanes'=>$bureau_de_douanes, "title"=>"Création d'un nouveau dossier d'importation"]);
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
        'num_lta'=>$this->num_lta,
        'num_sylvie'=>$this->num_sylvie,
        'num_declaration'=>$this->num_declaration,
        'valeur_caf'=>$this->valeur_caf,
        'nombre_colis'=>$this->nombre_colis,
        'poids'=>$this->poids,
        'fournisseur_id'=>$this->fournisseur,
        'bureau_de_douane_id'=>$this->bureau_de_douane,
        'type'=>"EXPORT",
        'user_id'=>1
        ]);


        if(Dossier::latest()->first()==null){

            $numero = "EX"."/".BureauDeDouane::find($this->bureau_de_douane)->code."/".strtoupper(substr($dossier->client->nom, 0, 3))."/".date('Y')."/".'0001';
        }else {
            $numero = "EX"."/".BureauDeDouane::find($this->bureau_de_douane)->code."/".strtoupper(substr($dossier->client->nom, 0, 3))."/".date('Y')."/".str_pad(Dossier::latest()->first()->id+1, 4, '0', STR_PAD_LEFT);
        }


        $dossier->numero = $numero;

        if($dossier->save()){
            $this->dispatch('new-dossier');
            request()->session()->flash("success", "Dossier ajuoté avec succès.");
            $this->reset();
        }else{
            request()->session()->flash("error", "Une erreur est survenue lors de l'enregistrement.");

        }
    }
}
