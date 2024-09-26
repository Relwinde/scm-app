<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\Marchandise;
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

        return view('livewire.modals.create-dossier-import', ["clients"=>$clients, "fournisseurs"=>$fournisseurs, "marchandises"=>$marchandises]);
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
}
