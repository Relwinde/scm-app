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
            $bonsDeCaisse = ModelsBonDeCaisse::select(['bon_de_caisses.id', 'bon_de_caisses.numero', 'bon_de_caisses.montant', 'bon_de_caisses.etape', 'bon_de_caisses.rejected', 'bon_de_caisses.dossier_id', 'bon_de_caisses.user_id', 'bon_de_caisses.created_at'])
                ->join('users', 'bond_de_caisses.user_id', '=', 'users.id')
                ->join('dossiers', 'bond_de_caisses.dossier_id', '=', 'dossiers.id')
                ->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                ->orWhere('users.name', 'like', "%{$this->search}%")
                ->orderBy('bon_de_caisses.created_at', 'DESC')
                ->paginate(10, '*', 'dossier-pagination');
        }
        else if (Auth::user()->can('Envoyer bon de caisse au responsable finance')){
            $bonsDeCaisse = ModelsBonDeCaisse::select(['bon_de_caisses.id', 'bon_de_caisses.numero', 'bon_de_caisses.montant', 'bon_de_caisses.etape', 'bon_de_caisses.rejected', 'bon_de_caisses.dossier_id', 'bon_de_caisses.user_id', 'bon_de_caisses.created_at'])
            ->join('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->join('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->where('bon_de_caisses.etape', 'COMPTABLE')
            ->where(function ($query){
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%")
                    ->orderBy('bon_de_caisses.created_at', 'DESC')
                    ->paginate(10, '*', 'dossier-pagination');
            });
           
        }
        else if (Auth::user()->can('Envoyer bon de caisse au responsable finance')){
            $bonsDeCaisse = ModelsBonDeCaisse::select(['bon_de_caisses.id', 'bon_de_caisses.numero', 'bon_de_caisses.montant', 'bon_de_caisses.etape', 'bon_de_caisses.rejected', 'bon_de_caisses.dossier_id', 'bon_de_caisses.user_id', 'bon_de_caisses.created_at'])
            ->join('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->join('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->where('bon_de_caisses.etape', 'COMPTABLE')
            ->orWhere('bon_de_caisses.user_id', Auth::user()->id)
            ->where(function ($query){
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%")
                    ->orderBy('bon_de_caisses.created_at', 'DESC')
                    ->paginate(10, '*', 'dossier-pagination');
            });
           
        }
        else if (Auth::user()->can('Envoyer bon de caisse au manager')){
            $bonsDeCaisse = ModelsBonDeCaisse::select(['bon_de_caisses.id', 'bon_de_caisses.numero', 'bon_de_caisses.montant', 'bon_de_caisses.etape', 'bon_de_caisses.rejected', 'bon_de_caisses.dossier_id', 'bon_de_caisses.user_id', 'bon_de_caisses.created_at'])
            ->join('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->join('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->where('bon_de_caisses.etape', 'RAF')
            ->orWhere('bon_de_caisses.user_id', Auth::user()->id)
            ->where(function ($query){
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%")
                    ->orderBy('bon_de_caisses.created_at', 'DESC')
                    ->paginate(10, '*', 'dossier-pagination');
            });
           
        }
        else if (Auth::user()->can('Envoyer bon de caisse à la caisser')){
            $bonsDeCaisse = ModelsBonDeCaisse::select(['bon_de_caisses.id', 'bon_de_caisses.numero', 'bon_de_caisses.montant', 'bon_de_caisses.etape', 'bon_de_caisses.rejected', 'bon_de_caisses.dossier_id', 'bon_de_caisses.user_id', 'bon_de_caisses.created_at'])
            ->join('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->join('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->where('bon_de_caisses.etape', 'MANAGER')
            ->orWhere('bon_de_caisses.user_id', Auth::user()->id)
            ->where(function ($query){
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%")
                    ->orderBy('bon_de_caisses.created_at', 'DESC')
                    ->paginate(10, '*', 'dossier-pagination');
            });
           
        }
        else if (Auth::user()->can('Payer bon de caisse')){
            $bonsDeCaisse = ModelsBonDeCaisse::select(['bon_de_caisses.id', 'bon_de_caisses.numero', 'bon_de_caisses.montant', 'bon_de_caisses.etape', 'bon_de_caisses.rejected', 'bon_de_caisses.dossier_id', 'bon_de_caisses.user_id', 'bon_de_caisses.created_at'])
            ->join('users', 'bon_de_caisses.user_id', '=', 'users.id')
            ->join('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
            ->where('bon_de_caisses.etape', 'CAISSE')
            ->orWhere('bon_de_caisses.user_id', Auth::user()->id)
            ->where(function ($query){
                $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%")
                    ->orderBy('bon_de_caisses.created_at', 'DESC')
                    ->paginate(10, '*', 'dossier-pagination');
            });
           
        }
        return view('livewire.bon-de-caisse');
    }
}
