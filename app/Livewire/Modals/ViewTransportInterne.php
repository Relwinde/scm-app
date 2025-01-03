<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use Livewire\Component;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\NumeroTransport;
use App\Models\TransportInterne;
use App\Exports\TransportDepenses;
use App\Models\Marchandise;
use LivewireUI\Modal\ModalComponent;
use Maatwebsite\Excel\Facades\Excel;


class ViewTransportInterne extends ModalComponent
{

    public TransportInterne $dossier;
    public $client;
    public $vehicule;
    public $chauffeur;
    public $montant;
    public $nombre_colis;
    public $poids;
    public $volume;
    public $total_depenses;
    public $edit = false;
    public $marchandise;

    public function mount (){
        $this->client = $this->dossier->client_id;
        $this->vehicule = $this->dossier->vehicule_id;
        $this->marchandise = $this->dossier->marchandises->first()->id ?? null;
        $this->chauffeur = $this->dossier->chauffeur_id;
        $this->nombre_colis = $this->dossier->nombre_colis;
        $this->montant = number_format(floatval( str_replace(' ', '',$this->dossier->montant)), 2, '.', ' ') ;
        $this->volume = number_format(floatval( str_replace(' ', '',$this->dossier->volume)), 2, '.', ' ') ;
        $this->poids = number_format(floatval( str_replace(' ', '',$this->dossier->poids)), 2, '.', ' ') ;

    }

    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $chauffeurs = Chauffeur::all(['id', 'nom']);
        $marchandises = Marchandise::all(['id', 'nom']);
        $vehicules = Vehicule::all(['id', 'immatriculation']);
        $this->total_depenses = $this->dossier->bon_de_caisse()->where(function ($query) {
            $query->where('etape', 'PAYE')
            ->orWhere('etape', 'CLOS');
        })->sum('montant_definitif');

        return view('livewire.modals.view-transport-interne',["clients"=>$clients, "chauffeurs"=>$chauffeurs, "marchandises"=>$marchandises, "vehicules"=>$vehicules, "title"=>"de transport interne"]);
    }

    public function setEdit(){
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->edit=true;
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function update (){
        $this->dossier->client_id = $this->client;
        $this->dossier->vehicule_id = $this->vehicule;
        $this->dossier->chauffeur_id = $this->chauffeur;
        $this->dossier->nombre_colis = $this->nombre_colis;
        $this->dossier->montant = floatval(str_replace(' ', '',$this->montant));
        $this->dossier->volume = floatval(str_replace(' ', '',$this->volume));
        $this->dossier->poids = floatval(str_replace(' ', '',$this->poids));



        if ($this->dossier->isDirty('client_id')){
            $this->dossier->updateNumero();
            NumeroTransport::create([
                'transport_interne_id'=>$this->dossier->id,
                'numero'=>$this->dossier->numero
            ]);
        }

        if($this->dossier->save()){
            $this->dispatch('new-dossier');
            $this->edit=false;
        }else{
            $this->dispatch('error');
        }

    }

    public function reformat_montant (){
        $this->montant = number_format(floatval( str_replace(' ', '',$this->montant)), 2, '.', ' ');
    }

    public function reformat_poids (){
        $this->poids = number_format(floatval( str_replace(' ', '',$this->poids)), 2, '.', ' ');
    }

    public function reformat_volume (){
        $this->volume = number_format(floatval( str_replace(' ', '',$this->volume)), 2, '.', ' ');
    }

    public function export (){
        return Excel::download(new TransportDepenses($this->dossier), str_replace('/', '-',$this->dossier->numero).'.xlsx');
    }
}
