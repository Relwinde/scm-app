<?php

namespace App\Livewire\Modals;

use App\Models\Client;
use App\Models\Dossier;
use Livewire\Component;
use App\Models\Fournisseur;
use App\Models\Marchandise;
use Livewire\Attributes\On;
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
    public $sommier;

    public $edit = false;
    public $value_error = false;
    public $declaration_error = false;

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
        $this->sommier = $this->dossier->sommier;
    }

    #[On('update-dossier')]
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
        $this->dossier->sommier = $this->sommier;
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
                $this->dispatch('update-dossier');
                $this->edit=false;
            }else{
                $this->dispatch('error');
            }
        } else {
            if($this->dossier->save()){
            
            $this->dispatch('update-dossier');
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
        
        if ($this->dossier->valeur_caf == null || $this->dossier->fob_xof == null ||  $this->dossier->valeur_caf == 0 || $this->dossier->fob_xof == 0){
            $this->dispatch('feuille-minute-novalue');
            $this->value_error = true;
        }
        else {
                $this->value_error = false;
                if (($this->dossier->status?->code == 'ssi') || $this->dossier->dossier_status_id == null) {
                    try {
                        $this->dossier->transitionTo('cod', Auth::user()->id);
                        $this->dispatch('update-dossier');
                        $this->dossier->save();
                        $this->dispatch('openModal', FeuilleMinute::class, ['dossier' => $this->dossier->id]);

                    } catch (\Exception $e) {
                        $this->dispatch('error');
                        return;
                    }
                } 
                else{
                    $this->dispatch('openModal', FeuilleMinute::class, ['dossier' => $this->dossier->id]);
                }
            }

           
        }

        public function confirmDeposit (){
            if(! Auth::user()->can('Enregistrer & déposer dossiers en douane')){
                $this->dispatch('not-allowed');
                return;
            }

            if ($this->dossier->status?->code != 'fm_def'){
                $this->dispatch('not-allowed');
                return;
            }

            if ($this->dossier->num_declaration == null || $this->dossier->num_declaration == ''){
                $this->declaration_error = true;
                $this->dispatch('declaration-error');
                return;
            }
            try {
                $this->dossier->transitionTo('eng_dep', Auth::user()->id);
                $this->dispatch('update-dossier');
                $this->dispatch('deposit-confirmed');
    
            } catch (\Exception $e) {
                $this->dispatch('status-transition-error');
                return;
            }
        }

        public function uploadBae (){
            if(! Auth::user()->can('Charger le BAE')){
                $this->dispatch('not-allowed');
                return;
            }

            if ($this->dossier->status?->code != 'eng_dep'){
                $this->dispatch('not-allowed');
                return;
            }

            if ($this->dossier->hasPassedThrough(['bae'])){
                $this->dispatch('bae-already-uploaded');
                return;
            }

            if ($this->dossier->num_declaration == null || $this->dossier->num_declaration == ''){
                $this->declaration_error = true;
                $this->dispatch('declaration-error');
                return;
            }

            $this->dispatch('openModal', 'modals.dossier.upload-bae', ['dossier' => $this->dossier->id]);
        }  

        public function uploadBordereauLivraison (){
            if(! Auth::user()->can('Charger les bordereaux de livraison signés')){
                $this->dispatch('not-allowed');
                return;
            }

            if ($this->dossier->status?->code != 'bae'){
                $this->dispatch('not-allowed');
                return;
            }

            if ($this->dossier->hasPassedThrough(['bordereau_livraison'])){
                $this->dispatch('bordereau-livraison-already-uploaded');
                return;
            }

            if ($this->dossier->num_declaration == null || $this->dossier->num_declaration == ''){
                $this->declaration_error = true;
                $this->dispatch('declaration-error');
                return;
            }

            $this->dispatch('openModal', 'modals.dossier.upload-bordereau-livraison', ['dossier' => $this->dossier->id]);
        }

        public function openBaseImputationModal (){
            if(! Auth::user()->can('Renseigner la base d\'imputation')){
                $this->dispatch('not-allowed');
                return;
            }

            if ($this->dossier->status?->code != 'fm_def' || $this->dossier->regime != 'EXO'){
                $this->dispatch('not-allowed');
                return;
            }

            $this->dispatch('openModal', 'modals.dossier.base-imputation', ['dossier' => $this->dossier->id]);
        }
        
        public function openDemandeExoModal (){
            if(! Auth::user()->can('Déposer le DI')){
                $this->dispatch('not-allowed');
                return;
            }

            if ($this->dossier->status?->code != 'ba_imp' || $this->dossier->regime != 'EXO'){
                $this->dispatch('not-allowed');
                return;
            }

            $this->dispatch('openModal', 'modals.dossier.upload-demande-exo', ['dossier' => $this->dossier->id]);
        }

        public function confirmDepositExo (){
            if(! Auth::user()->can('Enregistrer & déposer dossiers en douane')){
                $this->dispatch('not-allowed');
                return;
            }

            if ($this->dossier->num_declaration == null || $this->dossier->num_declaration == ''){
                $this->declaration_error = true;
                $this->dispatch('declaration-error');
                return;
            }
            try {
                $this->dossier->transitionTo('eng_dep', Auth::user()->id);
                $this->dispatch('update-dossier');
                $this->dispatch('deposit-confirmed');
    
            } catch (\Exception $e) {
                $this->dispatch('status-transition-error');
                return;
            }
            
        }

    
        public function openDecisionExoModal (){
            if(! Auth::user()->can('Confirmer la reponse de la DE')){
                $this->dispatch('not-allowed');
                return;
            }


            if ($this->dossier->status?->code != 'di_dep' || $this->dossier->regime != 'EXO'){
                $this->dispatch('not-allowed');
                return;
            }
            
            $this->dispatch('openModal', 'modals.dossier.confirm-decision-exo', ['dossier' => $this->dossier->id]);
        }

        public function setFacturation (){
            if(! Auth::user()->can('Transmettre un dossier pour facturation') || $this->dossier->status?->code != 'lvr'){
                $this->dispatch('not-allowed');
                return;
            }

            try {
                $this->dossier->transitionTo('tr_fact', Auth::user()->id);
                $this->dispatch('update-dossier');
                $this->dispatch('facturation-transmitted');
    
            } catch (\Exception $e) {
                $this->dispatch('status-transition-error');
                return;
            }
        }

        public function setFacture (){
            if(! Auth::user()->can('Facturer un dossier') || $this->dossier->status?->code != 'tr_fact'){
                $this->dispatch('not-allowed');
                return;
            }

            $this->dispatch('openModal', 'modals.dossier.confirm-facture', ['dossier' => $this->dossier->id]);
        }

        public function setPayment (){
            if(! Auth::user()->can('Valider le paiement d\'un dossier') || $this->dossier->status?->code != 'fact'){
                $this->dispatch('not-allowed');
                return;
            }

            $this->dispatch('openModal', 'modals.dossier.confirm-payment', ['dossier' => $this->dossier->id]);
        }

        public function setArchive (){
            if(! Auth::user()->can('Archiver un dossier') || $this->dossier->status?->code != 'pay'){
                $this->dispatch('not-allowed');
                return;
            }

            try { 
                $this->dossier->transitionTo('arch', auth()->user()->id);
                $this->dispatch('update-dossier');
            } catch (\Throwable $th) {
                $this->dispatch('status-transition-error');
                return;
            }
        }
    
}
