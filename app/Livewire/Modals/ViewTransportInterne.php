<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use Livewire\Component;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\NumeroTransport;
use App\Models\TransportInterne;
use App\Exports\TransportDepenses;
use LivewireUI\Modal\ModalComponent;
use Maatwebsite\Excel\Facades\Excel;


class ViewTransportInterne extends ModalComponent
{

    public TransportInterne $dossier;
    public $client;
    public $vehicule;
    public $chauffeur;
    public $montant;
    public $total_depenses;
    public $edit = false;

    public function mount (){
        $this->client = $this->dossier->client_id;
        $this->vehicule = $this->dossier->vehicule_id;
        $this->chauffeur = $this->dossier->chauffeur_id;
        $this->montant = number_format(floatval( str_replace(' ', '',$this->dossier->montant)), 2, '.', ' ') ;
    }

    public function render()
    {
        $clients = Client::all(['id', 'nom']);
        $chauffeurs = Chauffeur::all(['id', 'nom']);
        $vehicules = Vehicule::all(['id', 'immatriculation']);
        $this->total_depenses = $this->dossier->bon_de_caisse()->where('etape', 'PAYE')->orWhere('etape', 'CLOS')->sum('montant_definitif');

        return view('livewire.modals.view-transport-interne',["clients"=>$clients, "chauffeurs"=>$chauffeurs, "vehicules"=>$vehicules, "title"=>"de transport interne"]);
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
        $this->dossier->montant = floatval(str_replace(' ', '',$this->montant));


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

    public function export (){
        return Excel::download(new TransportDepenses($this->dossier), str_replace('/', '-',$this->dossier->numero).'.xlsx');
    }
}
