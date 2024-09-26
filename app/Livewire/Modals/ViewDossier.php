<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Fournisseur;
use App\Models\Marchandise;
use LivewireUI\Modal\ModalComponent;

class ViewDossier extends ModalComponent
{
    public Dossier $dossier;
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
        $this->num_commande = $this->dossier->num_commande;
        $this->client = $this->dossier->client_id;
        $this->fournisseur = $this->dossier->fournisseur_id;
        $this->num_facture = $this->dossier->num_facture;
        // $this->marchandise = $this->dossier->marchandise->id;
        $this->num_dpi = $this->dossier->num_dpi;
        $this->nombre_colis = $this->dossier->nombre_colis;
        $this->poids = $this->dossier->poids;
        $this->num_lta = $this->dossier->num_lta;
        $this->num_declaration = $this->dossier->num_declaration;
        $this->valeur_caf = $this->dossier->valeur_caf;

        $clients = Client::all(['id', 'nom']);
        $fournisseurs = Fournisseur::all(['id', 'nom']);
        $marchandises = Marchandise::all(['id', 'nom']);

        return view('livewire.modals.view-dossier', ["clients"=>$clients, "fournisseurs"=>$fournisseurs, "marchandises"=>$marchandises, "title"=>"d'importation"]);
    }
}
