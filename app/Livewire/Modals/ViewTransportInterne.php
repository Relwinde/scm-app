<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use Livewire\Component;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use App\Models\Marchandise;
use Livewire\Attributes\On;
use App\Models\NumeroTransport;
use App\Models\TransportInterne;
use App\Exports\TransportDepenses;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MarchandiseTransportInterne;


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
    public $num_lta_bl;
    public $num_commande;

    public $last_update;

    public function mount (){
        $this->client = $this->dossier->client_id;
        $this->vehicule = $this->dossier->vehicule_id;
        $this->marchandise = $this->dossier->marchandises->first()->id ?? null;
        $this->chauffeur = $this->dossier->chauffeur_id;
        $this->nombre_colis = $this->dossier->nombre_colis;
        $this->montant = number_format(floatval( str_replace(' ', '',$this->dossier->montant)), 2, '.', ' ') ;
        $this->volume = number_format(floatval( str_replace(' ', '',$this->dossier->volume)), 2, '.', ' ') ;
        $this->poids = number_format(floatval( str_replace(' ', '',$this->dossier->poids)), 2, '.', ' ') ;
        $this->num_lta_bl = $this->dossier->num_lta_bl;
        $this->num_commande = $this->dossier->num_commande;

        $this->last_update = $this->dossier->daysInCurrentStatus();


    }

    #[On('update-dossier')]
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
        $this->dossier->num_lta_bl = $this->num_lta_bl;
        $this->dossier->num_commande = $this->num_commande;



        if ($this->dossier->isDirty('client_id')){
            $this->dossier->updateNumero();
            NumeroTransport::create([
                'transport_interne_id'=>$this->dossier->id,
                'numero'=>$this->dossier->numero
            ]);
        }

        $marchaniseTransportInterne = MarchandiseTransportInterne::where('transport_interne_id', $this->dossier->id)->first();
        if($marchaniseTransportInterne){
            $marchaniseTransportInterne->marchandise_id = $this->marchandise;
            $marchaniseTransportInterne->save();
        }else{
            MarchandiseTransportInterne::create([
                'transport_interne_id'=>$this->dossier->id,
                'marchandise_id'=>$this->marchandise
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

    public function uploadBordereauLivraison (){
        if(! Auth::user()->can('Charger les bordereaux de livraison signés')){
                $this->dispatch('not-allowed');
                return;
            }

        if ($this->dossier->status?->code != 'ecl'){
                $this->dispatch('not-allowed');
                return;
            }

        $this->dispatch('openModal', 'modals.transport-interne.upload-bordereau-livraison', ['dossier' => $this->dossier->id]);
    }

    public function setFacturation (){
        if(! Auth::user()->can('Transmettre un dossier pour facturation') || $this->dossier->status?->code != 'lvr'){
            $this->dispatch('not-allowed');
            return;
        }
        

        try {
            DB::beginTransaction();
            $this->dossier->transitionTo('tr_fact', Auth::user()->id);
            $this->dispatch('update-dossier');
            $this->dispatch('facturation-transmitted');
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('status-transition-error');
            return;
        }
    }

    public function setFacture (){
        if(! Auth::user()->can('Facturer un dossier') || $this->dossier->status?->code != 'tr_fact'){
            $this->dispatch('not-allowed');
            return;
        }

        $this->dispatch('openModal', 'modals.transport-interne.confirm-facture', ['dossier' => $this->dossier->id]);
    }

    public function setPayment (){
        if(! Auth::user()->can('Valider le paiement d\'un dossier') || $this->dossier->status?->code != 'fact'){
            $this->dispatch('not-allowed');
            return;
        }

        $this->dispatch('openModal', 'modals.transport-interne.confirm-payment', ['dossier' => $this->dossier->id]);
    }

    public function setArchive (){
        if(! Auth::user()->can('Archiver un dossier') || $this->dossier->status?->code != 'pay'){
            $this->dispatch('not-allowed');
            return;
        }

        try {
            DB::beginTransaction(); 
            $this->dossier->transitionTo('arch', auth()->user()->id);
            $this->dispatch('update-dossier');
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->dispatch('status-transition-error');
            return;
        }
    }


}
