<?php

namespace App\Livewire\Modals\Dossier;

use Exception;
use App\Models\Article;
use App\Models\Dossier;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class FeuilleMinute extends ModalComponent
{

    public Dossier $dossier;

    public bool $edit = false;
    public $editId;
    public $edit_name;
    public $edit_code; 
    public $edit_fob_devis;
    public $edit_fob_xof;
    public $edit_fret;
    public $edit_autres_frais;
    public $edit_assurance;
    public $edit_caf;
    public $edit_poids_brut;
    public $edit_poids_net;
    public $edit_quantite_supp;
    public $edit_origin;

    public $name;
    public $code; 
    public $fob_devis;
    public $fob_xof;
    public $fret;
    public $autres_frais;
    public $assurance;
    public $caf;
    public $poids_brut;
    public $poids_net;
    public $quantite_supp;
    public $origin;

    #[on('feuille-minute-confirmed')]
    public function render()
    {
        $articles = $this->dossier->articles()->orderBy('created_at', 'asc')->paginate(10);
        return view('livewire.modals.dossier.feuille-minute', compact('articles'));
    }

    public function setEdit (Article $article)
    {
        if($this->edit == true){
            $this->edit=false;
        }
        else{
            $this->editId = $article->id;
            $this->edit_name = $article->name;
            $this->edit_code = $article->code;
            $this->edit_fob_devis = $article->fob_devis;
            $this->edit_fob_xof = $article->fob_xof;
            $this->edit_fret = $article->fret;
            $this->edit_autres_frais = $article->autres_frais;
            $this->edit_assurance = $article->assurance;
            $this->edit_caf = $article->caf;
            $this->edit_poids_brut = $article->poids_brut;
            $this->edit_poids_net = $article->poids_net;
            $this->edit_quantite_supp = $article->quantite_supp;
            $this->edit_origin = $article->origin;
            $this->edit=true;
        }
    }

    public function calculate (){
        $portion = floatval($this->fob_xof) / floatval($this->dossier->fob_xof);

        $value = $portion * floatval($this->dossier->fob_devis);
        $decimal = $value - floor($value);
        $this->fob_devis = $decimal >= 0.5 ? ceil($value) : floor($value);

        $value = $portion * floatval($this->dossier->poids);
        $decimal = $value - floor($value);
        $this->poids_net = $decimal >= 0.5 ? ceil($value) : floor($value);

        $value = $portion * floatval($this->dossier->poids);
        $decimal = $value - floor($value);
        $this->poids_brut = $decimal >= 0.5 ? ceil($value) : floor($value);

        $value = $portion * floatval($this->dossier->fret);
        $decimal = $value - floor($value);
        $this->fret = $decimal >= 0.5 ? ceil($value) : floor($value);

        $value = $portion * floatval($this->dossier->assurance);
        $decimal = $value - floor($value);
        $this->assurance = $decimal >= 0.5 ? ceil($value) : floor($value);

        $value = $portion * floatval($this->dossier->autre_frais);
        $decimal = $value - floor($value);
        $this->autres_frais = $decimal >= 0.5 ? ceil($value) : floor($value);

        $this->caf =  floatval($this->fob_xof) + floatval($this->fret) + floatval($this->assurance) + floatval($this->autres_frais);
    }

    public function calculateEdit (){
        $this->edit_caf =  floatval($this->edit_fob_xof) + floatval($this->edit_fret) + floatval($this->edit_assurance) + floatval($this->edit_autres_frais);
    }

    public function createArticle (){
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'fob_devis' => 'required|numeric',
            'fob_xof' => 'required|numeric',
            'fret' => 'required|numeric',
            'autres_frais' => 'required|numeric',
            'assurance' => 'required|numeric',
            'caf' => 'required|numeric',
            'poids_brut' => 'required|numeric',
            'poids_net' => 'required|numeric',
            'quantite_supp' => 'required|numeric',
            'origin' => 'required|string|max:255',
        ],
        [
            'required' => 'Ce champ est requis.',
            'numeric' => 'Ce champ doit être un nombre.',
            'string' => 'Ce champ doit être une chaîne de caractères.',
            'max' => 'Ce champ ne peut pas dépasser :max caractères.',
        ]);

        $this->dossier->articles()->create([
            'name' => $this->name,
            'code' => $this->code,
            'fob_devis' => $this->fob_devis,
            'fob_xof' => $this->fob_xof,
            'fret' => $this->fret,
            'autres_frais' => $this->autres_frais,
            'assurance' => $this->assurance,
            'caf' => $this->caf,
            'poids_brut' => $this->poids_brut,
            'poids_net' => $this->poids_net,
            'quantite_supp' => $this->quantite_supp,
            'origin' => $this->origin,
            'user_id' => auth()->id(),
            'dossier_id' => $this->dossier->id
        ]);

        $this->reset(['name', 'code', 'fob_devis', 'fob_xof', 'fret', 'autres_frais', 'assurance', 'caf', 'poids_brut', 'poids_net', 'quantite_supp', 'origin']);
    }

    public function removeArticle (Article $article){
        $this->dossier->articles()->where('id', $article->id)->delete();
    }

    public function setFeuilleMinute (){

        //Todo: Check dossier caf value and articles caf sum

        $this->dispatch('openModal', ConfirmFeuilleMinute::class, ['dossier' => $this->dossier]);
        
    }

    public function update (Article $article){
        $this->validate([
            'edit_name' => 'required|string|max:255',
            'edit_code' => 'required|string|max:255',
            'edit_fob_devis' => 'required|numeric',
            'edit_fob_xof' => 'required|numeric',
            'edit_fret' => 'required|numeric',
            'edit_autres_frais' => 'required|numeric',
            'edit_assurance' => 'required|numeric',
            'edit_caf' => 'required|numeric',
            'edit_poids_brut' => 'required|numeric',
            'edit_poids_net' => 'required|numeric',
            'edit_quantite_supp' => 'required|numeric',
            'edit_origin' => 'required|string|max:255',
        ],
        [
            'required' => 'Ce champ est requis.',
            'numeric' => 'Ce champ doit être un nombre.',
            'string' => 'Ce champ doit être une chaîne de caractères.',
            'max' => 'Ce champ ne peut pas dépasser :max caractères.',
        ]);

        $article->update([
            'name' => $this->edit_name,
            'code' => $this->edit_code,
            'fob_devis' => $this->edit_fob_devis,
            'fob_xof' => $this->edit_fob_xof,
            'fret' => $this->edit_fret,
            'autres_frais' => $this->edit_autres_frais,
            'assurance' => $this->edit_assurance,
            'caf' => $this->edit_caf,
            'poids_brut' => $this->edit_poids_brut,
            'poids_net' => $this->edit_poids_net,
            'quantite_supp' => $this->edit_quantite_supp,
            'origin' => $this->edit_origin,
        ]);

        $this->reset(['edit_name', 'edit_code', 'edit_fob_devis', 'edit_fob_xof', 'edit_fret', 'edit_autres_frais', 'edit_assurance', 'edit_caf', 'edit_poids_brut', 'edit_poids_net', 'edit_quantite_supp', 'edit_origin']);

        $this->edit = false;
        $this->editId = null;
    }

    public function print (){

        if ($this->dossier->status->code =="cod"){
            try {
                $this->transitionTo('fm_prov', Auth::user()->id);  
            } catch (Exception $e) {
                
            }

            $this->dispatch('print-feuille-minute');
        }

    }

    public static function destroyOnClose(): bool
    {
        return true;
    }
}
