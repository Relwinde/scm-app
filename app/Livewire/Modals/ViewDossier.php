<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Fournisseur;
use App\Models\Marchandise;
use App\Models\NumeroDossier;
use App\Models\BureauDeDouane;
use App\Exports\DossierDepenses;
use App\Models\DossierMarchandise;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;
use Maatwebsite\Excel\Facades\Excel;
use App\Livewire\Modals\Dossier\FeuilleMinute;

class ViewDossier extends ModalComponent
{
    public Dossier $dossier;
    public $num_commande;
    public $client;
    public $fournisseur;
    public $num_facture;
    public $marchandise;
    public $num_sylvie;
    public $origine;
    public $nombre_colis;
    public $poids;
    public $num_declaration;
    public $valeur_caf;
    public $bureau_de_douane;
    public $num_exo;
    public $num_lta_bl;
    public $num_t;
    public $total_depenses;
    public $fob_xof;
    public $fob_devis;
    public $fret;
    public $assurance;
    public $autre_frais;

    public $edit = false;
    public $value_error = false;

    public function mount(){
        $this->num_commande = $this->dossier->num_commande;
        $this->client = $this->dossier->client_id;
        $this->fournisseur = $this->dossier->fournisseur;
        $this->bureau_de_douane = $this->dossier->bureau_de_douane->id;
        $this->num_facture = $this->dossier->num_facture;
        $this->marchandise = $this->dossier->marchandises->first()->id ?? null;
        $this->num_sylvie = $this->dossier->num_sylvie;
        $this->origine = $this->dossier->origine;
        $this->num_exo = $this->dossier->num_exo;
        $this->num_lta_bl = $this->dossier->num_lta_bl;
        $this->num_t = $this->dossier->num_t;
        $this->nombre_colis = number_format($this->dossier->nombre_colis, 2, '.', ' ');
        $this->poids = number_format($this->dossier->poids, 2, '.', ' ');
        $this->num_declaration = $this->dossier->num_declaration;
        $this->valeur_caf = number_format($this->dossier->valeur_caf, 2, '.', ' ');
        $this->fob_xof = number_format($this->dossier->fob_xof, 2, '.', ' ');
        $this->fob_devis = number_format($this->dossier->fob_devis, 2, '.', ' ');
        $this->fret = number_format($this->dossier->fret, 2, '.', ' ');
        $this->assurance = number_format($this->dossier->assurance, 2, '.', ' ');
        $this->autre_frais = number_format($this->dossier->autre_frais, 2, '.', ' ');
    }

    public function render()
    {

        $clients = Client::all(['id', 'nom']);
        $fournisseurs = Fournisseur::all(['id', 'nom']);
        $marchandises = Marchandise::all(['id', 'nom']);
        $bureau_de_douanes = BureauDeDouane::all(['id', 'nom']);
        $this->total_depenses = $this->dossier->bon_de_caisse()->where(function ($query) {
            $query->where('etape', 'PAYE')
            ->orWhere('etape', 'CLOS');
        })->sum('montant_definitif');
        
        


        return view('livewire.modals.view-dossier', ["clients"=>$clients, "fournisseurs"=>$fournisseurs, "marchandises"=>$marchandises, 'bureau_de_douanes'=>$bureau_de_douanes, "title"=>"d'importation"]);
    }

    public function setEdit(){
        if($this->edit == true){
            $this->edit=false;
            $this->mount();
        }
        else{
            $this->edit=true;
        }
    }

    public function update(){
        $this->dossier->num_commande = $this->num_commande;
        $this->dossier->client_id = $this->client;
        $this->dossier->fournisseur = $this->fournisseur;
        $this->dossier->bureau_de_douane_id = $this->bureau_de_douane;
        $this->dossier->num_facture = $this->num_facture;
        // $this->marchandise = $this->dossier->marchandises->first()->id;
        $this->dossier->num_sylvie = $this->num_sylvie;
        $this->dossier->origine = $this->origine;
        $this->dossier->num_exo = $this->num_exo;
        $this->dossier->num_lta_bl = $this->num_lta_bl;
        $this->dossier->num_t = $this->num_t;
        $this->dossier->nombre_colis = floatval(str_replace(' ', '', $this->nombre_colis));
        $this->dossier->poids = floatval( str_replace(' ', '',$this->poids));
        $this->dossier->num_declaration = $this->num_declaration;
        $this->dossier->valeur_caf =floatval( str_replace(' ', '',$this->valeur_caf));
        $this->dossier->fob_xof =floatval( str_replace(' ', '',$this->fob_xof));
        $this->dossier->fob_devis =floatval( str_replace(' ', '',$this->fob_devis));
        $this->dossier->fret =floatval( str_replace(' ', '',$this->fret));
        $this->dossier->assurance =floatval( str_replace(' ', '',$this->assurance));
        $this->dossier->autre_frais =floatval( str_replace(' ', '',$this->autre_frais));

        if ($this->dossier->isDirty('bureau_de_douane_id') || $this->dossier->isDirty('client_id')){
            $this->dossier->updateNumero();
            if($this->dossier->save()){
                NumeroDossier::create([
                    'dossier_id'=>$this->dossier->id,
                    'numero'=>$this->dossier->numero
                ]);
                $this->dispatch('new-dossier');
                $this->edit=false;
            }else{
                $this->dispatch('error');
            }
        } else {
            if($this->dossier->save()){
            
            $this->dispatch('new-dossier');
            $this->edit=false;
            }else{
                $this->dispatch('error');
            }
        }
        
        $dossierMarhandise = DossierMarchandise::where('dossier_id', $this->dossier->id)->first();
        if($dossierMarhandise){
            $dossierMarhandise->marchandise_id = $this->marchandise;
            $dossierMarhandise->save();
        }else{
            DossierMarchandise::create([
                'dossier_id'=>$this->dossier->id,
                'marchandise_id'=>$this->marchandise
            ]);
        }
        
    }

    public static function destroyOnClose(): bool
    {
        return true;
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

    public function reformat_fob_xof (){
        $this->fob_xof= number_format(floatval( str_replace(' ', '',$this->fob_xof)), 2, '.', ' ');
    }

    public function reformat_fob_devis (){
        $this->fob_devis= number_format(floatval( str_replace(' ', '',$this->fob_devis)), 2, '.', ' ');
    }

    public function reformat_fret (){
        $this->fret = number_format(floatval( str_replace(' ', '',$this->fret)), 2, '.', ' ');
    }

    public function reformat_assurance (){
        $this->assurance = number_format(floatval( str_replace(' ', '',$this->assurance)), 2, '.', ' ');
    }

    public function reformat_autre_frais (){
        $this->autre_frais = number_format(floatval( str_replace(' ', '',$this->autre_frais)), 2, '.', ' ');
    }

    public function export (){
        return Excel::download(new DossierDepenses($this->dossier), str_replace('/', '-',$this->dossier->numero).'.xlsx');
    }

    public function feuilleMinute (){
        if(! Auth::user()->can('Etablir la feuille minute')){
            $this->dispatch('not-allowed');
            return;
        }
        
        if ($this->dossier->valeur_caf == null || $this->dossier->fob_xof == null || $this->fret == null || $this->dossier->assurance == null || $this->dossier->valeur_caf == 0 || $this->dossier->fob_xof == 0 || $this->fret == 0 || $this->dossier->assurance == 0){
            $this->dispatch('feuille-minute-novalue');
            $this->value_error = true;
        }
        else {
            $this->value_error = false;
            $this->dispatch('openModal', FeuilleMinute::class, ['dossier' => $this->dossier->id]);

        }
    }
    
}
