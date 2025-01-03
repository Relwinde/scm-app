<?php

namespace App\Livewire\Modals;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\NumeroTransport;
use App\Models\TransportInterne;
use App\Models\Marchandise;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class CreateTransportInterne extends ModalComponent
{
    public $client;
    public $vehicule;
    public $chauffeur;
    public $montant;
    public $nombre_colis;
    public $poids;
    public $volume;
    public $marchandise;

    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $chauffeurs = Chauffeur::all(['id', 'nom']);
        $vehicules = Vehicule::all(['id', 'immatriculation', 'description']);
        $marchandises = Marchandise::all(['id', 'nom']);


        return view('livewire.modals.create-transport-interne',["clients"=>$clients, "marchandises"=>$marchandises, "chauffeurs"=>$chauffeurs, "vehicules"=>$vehicules, "title"=>"de transport interne"]);
    }

    public function create(){
        $dossier = TransportInterne::make([
        'montant'=>floatval(str_replace(' ', '',$this->montant)),
        'poids'=>floatval(str_replace(' ', '',$this->poids)),
        'volume'=>floatval(str_replace(' ', '',$this->volume)),
        'nombre_colis'=>$this->nombre_colis,
        'client_id'=>$this->client,
        'vehicule_id'=>$this->vehicule,
        'chauffeur_id'=>$this->chauffeur,
        'user_id'=>Auth::User()->id
        ]);

        if(TransportInterne::whereYear('created_at', Carbon::now()->year)->latest()->first() == null){
            $numero = "TP04-".strtoupper($dossier->client->code)."/".date('Y').'0001';
        }else {
            $ordre = NumeroTransport::whereYear('created_at', Carbon::now()->year)->count() + 1;
            do{
                $numero = "TP04-".strtoupper($dossier->client->code)."/".date('Y').str_pad($ordre, 4, '0', STR_PAD_LEFT);
                $ordre++; 
                $pattern = explode('/', $numero)[1];
            }
            while(NumeroTransport::where('numero', 'LIKE', "%/{$pattern}")->whereYear('created_at', Carbon::now()->year)->count() > 0);
        }

        $dossier->numero = $numero;
    
        if($dossier->save()){
            NumeroTransport::create([
                'transport_interne_id'=>$dossier->id,
                'numero'=>$dossier->numero
            ]);
            $dossier->marchandises()->attach($this->marchandise);
            $this->dispatch('new-dossier');
            $this->reset();
        }else{
            $this->dispatch('error');
        }
    }

    public static function destroyOnClose(): bool
    {
        return true;
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
}
