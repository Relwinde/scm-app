<?php

namespace App\Livewire;

use App\Models\BonDeCaisse as ModelsBonDeCaisse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class BonDeCaisse extends Component
{

    public $search;

    use WithPagination;

    #[On('new-bon-de-caisse')]
    public function render()
    {
        if (Auth::user()->can('Voir toute la liste des bons de caisse')){
            
            $bonsDeCaisse = ModelsBonDeCaisse::select([
                'bon_de_caisses.id',
                'bon_de_caisses.numero',
                'bon_de_caisses.montant',
                'bon_de_caisses.depense',
                'bon_de_caisses.etape',
                'bon_de_caisses.rejected',
                'bon_de_caisses.dossier_id',
                'transport_interne_id',
                'bon_de_caisses.user_id',
                'bon_de_caisses.created_at'
            ])
            ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
            ->where(function ($query) {
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                      ->orWhere('bon_de_caisses.depense', 'like', "%{$this->search}%")
                      ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                      ->orWhere('transport_internes.numero', 'like', "%{$this->search}%")
                      ->orWhere('users.name', 'like', "%{$this->search}%");
            })
            ->orderBy('bon_de_caisses.created_at', 'DESC')
            ->paginate(10, '*', 'bons-pagination');
        
        }else if (Auth::user()->can('Envoyer bon de caisse au responsable finance')){
            $bonsDeCaisse = ModelsBonDeCaisse::select([
                'bon_de_caisses.id',
                'bon_de_caisses.numero',
                'bon_de_caisses.montant',
                'bon_de_caisses.depense',
                'bon_de_caisses.etape',
                'bon_de_caisses.rejected',
                'bon_de_caisses.dossier_id',
                'transport_interne_id',
                'bon_de_caisses.user_id',
                'bon_de_caisses.created_at'
            ])
            ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
            ->where(function ($query) {
                $query->where('bon_de_caisses.etape', 'COMPTABLE')
                      ->orWhere('bon_de_caisses.user_id', Auth::user()->id);
            })
            ->where(function ($query) {
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                      ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                      ->orWhere('users.name', 'like', "%{$this->search}%");
            })
            ->orderBy('bon_de_caisses.created_at', 'DESC')
            ->paginate(10, '*', 'bons-pagination');           
        }
        else if (Auth::user()->can('Envoyer bon de caisse au manager')){
            $bonsDeCaisse = ModelsBonDeCaisse::select([
                'bon_de_caisses.id',
                'bon_de_caisses.numero',
                'bon_de_caisses.montant',
                'bon_de_caisses.depense',
                'bon_de_caisses.etape',
                'bon_de_caisses.rejected',
                'bon_de_caisses.dossier_id',
                'transport_interne_id',
                'bon_de_caisses.user_id',
                'bon_de_caisses.created_at'
            ])
            ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
            ->where(function ($query) {
                $query->where('bon_de_caisses.etape', 'RAF')
                      ->orWhere('bon_de_caisses.user_id', Auth::user()->id);
            })
            ->where(function ($query) {
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                      ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                      ->orWhere('users.name', 'like', "%{$this->search}%");
            })
            ->orderBy('bon_de_caisses.created_at', 'DESC')
            ->paginate(10, '*', 'bons-pagination');           
        }
        else if (Auth::user()->can('Envoyer bon de caisse à la caisser')){
            $bonsDeCaisse = ModelsBonDeCaisse::select([
                'bon_de_caisses.id',
                'bon_de_caisses.numero',
                'bon_de_caisses.montant',
                'bon_de_caisses.depense',
                'bon_de_caisses.etape',
                'bon_de_caisses.rejected',
                'bon_de_caisses.dossier_id',
                'transport_interne_id',
                'bon_de_caisses.user_id',
                'bon_de_caisses.created_at'
            ])
            ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
            ->where(function ($query) {
                $query->where('bon_de_caisses.etape', 'MANAGER')
                      ->orWhere('bon_de_caisses.user_id', Auth::user()->id);
            })
            ->where(function ($query) {
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                      ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                      ->orWhere('users.name', 'like', "%{$this->search}%");
            })
            ->orderBy('bon_de_caisses.created_at', 'DESC')
            ->paginate(10, '*', 'bons-pagination');        
           
        }
        else if (Auth::user()->can('Payer bon de caisse')){

            $bonsDeCaisse = ModelsBonDeCaisse::select([
                'bon_de_caisses.id',
                'bon_de_caisses.numero',
                'bon_de_caisses.montant',
                'bon_de_caisses.depense',
                'bon_de_caisses.etape',
                'bon_de_caisses.rejected',
                'bon_de_caisses.dossier_id',
                'transport_interne_id',
                'bon_de_caisses.user_id',
                'bon_de_caisses.created_at'
            ])
            ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
            ->where(function ($query) {
                $query->where('bon_de_caisses.etape', 'CAISSE')
                      ->orWhere('bon_de_caisses.user_id', Auth::user()->id);
            })
            ->where(function ($query) {
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                      ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                      ->orWhere('users.name', 'like', "%{$this->search}%");
            })
            ->orderBy('bon_de_caisses.created_at', 'DESC')
            ->paginate(10, '*', 'bons-pagination');        
           
        }

        return view('livewire.bon-de-caisse', [
            'bonsDeCaisse' => $bonsDeCaisse, 'header_title'=>'Bons de caisse', 'create_modal'=>'modals.create-bon-de-caisse', 'button_title'=>'Nouveau bon'
        ]);
    }
}