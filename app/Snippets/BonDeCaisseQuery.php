<?php

use App\Models\BonDeCaisse;
use Illuminate\Support\Facades\Auth;

if (Auth::user()->can('Voir toute la liste des bons de caisse')){
            
    $bonsDeCaisse = BonDeCaisse::select([
        'bon_de_caisses.id',
        'bon_de_caisses.numero',
        'bon_de_caisses.montant_definitif',
        'bon_de_caisses.depense',
        'bon_de_caisses.etape',
        'bon_de_caisses.rejected',
        'bon_de_caisses.dossier_id',
        'bon_de_caisses.transport_interne_id',
        'bon_de_caisses.vehicule_id',
        'bon_de_caisses.user_id',
        'bon_de_caisses.created_at'
    ])
    ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
    ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
    ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
    ->leftjoin('vehicules', 'bon_de_caisses.vehicule_id', '=', 'vehicules.id')
    ->where(function ($query) {
        $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                ->orWhere('bon_de_caisses.etape', 'like', "%{$this->search}%")
                ->orWhere('bon_de_caisses.depense', 'like', "%{$this->search}%")
                ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                ->orWhere('transport_internes.numero', 'like', "%{$this->search}%")
                ->orWhere('users.name', 'like', "%{$this->search}%")
                ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%");
    })
    ->orderBy('bon_de_caisses.created_at', 'DESC')
    ->paginate(10, '*', 'bons-pagination');

}else if (Auth::user()->can('Envoyer bon de caisse au manager')){
    $bonsDeCaisse = BonDeCaisse::select([
        'bon_de_caisses.id',
        'bon_de_caisses.numero',
        'bon_de_caisses.montant_definitif',
        'bon_de_caisses.depense',
        'bon_de_caisses.etape',
        'bon_de_caisses.rejected',
        'bon_de_caisses.dossier_id',
        'bon_de_caisses.vehicule_id',
        'bon_de_caisses.transport_interne_id',
        'bon_de_caisses.user_id',
        'bon_de_caisses.created_at'
    ])
    ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
    ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
    ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
    ->leftjoin('vehicules', 'bon_de_caisses.vehicule_id', '=', 'vehicules.id')
    ->where(function ($query) {
        $query->where('bon_de_caisses.etape', 'RESPONSABLE')
              ->orWhere('bon_de_caisses.user_id', Auth::user()->id);
    })
    ->where(function ($query) {
        $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                ->orWhere('bon_de_caisses.etape', 'like', "%{$this->search}%")
                ->orWhere('bon_de_caisses.depense', 'like', "%{$this->search}%")
                ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                ->orWhere('transport_internes.numero', 'like', "%{$this->search}%")
                ->orWhere('users.name', 'like', "%{$this->search}%")
                ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%");
    })
    ->orderBy('bon_de_caisses.created_at', 'DESC')
    ->paginate(10, '*', 'bons-pagination');           
}
else if (Auth::user()->can('Envoyer bon de caisse au RAF')){
    $bonsDeCaisse = BonDeCaisse::select([
        'bon_de_caisses.id',
        'bon_de_caisses.numero',
        'bon_de_caisses.montant_definitif',
        'bon_de_caisses.depense',
        'bon_de_caisses.etape',
        'bon_de_caisses.rejected',
        'bon_de_caisses.dossier_id',
        'bon_de_caisses.vehicule_id',
        'bon_de_caisses.transport_interne_id',
        'bon_de_caisses.user_id',
        'bon_de_caisses.created_at'
    ])
    ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
    ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
    ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
    ->leftjoin('vehicules', 'bon_de_caisses.vehicule_id', '=', 'vehicules.id')
    ->where(function ($query) {
        $query->where('bon_de_caisses.etape', 'MANAGER')
              ->orWhere('bon_de_caisses.user_id', Auth::user()->id);
    })
    ->where(function ($query) {
        $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                    ->orWhere('bon_de_caisses.etape', 'like', "%{$this->search}%")
                    ->orWhere('bon_de_caisses.depense', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('transport_internes.numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%")
                    ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%");
    })
    ->orderBy('bon_de_caisses.created_at', 'DESC')
    ->paginate(10, '*', 'bons-pagination');        
   
}
else if (Auth::user()->can('Envoyer bon de caisse à la caisse')){
    $bonsDeCaisse = BonDeCaisse::select([
        'bon_de_caisses.id',
        'bon_de_caisses.numero',
        'bon_de_caisses.montant_definitif',
        'bon_de_caisses.depense',
        'bon_de_caisses.etape',
        'bon_de_caisses.rejected',
        'bon_de_caisses.dossier_id',
        'bon_de_caisses.vehicule_id',
        'bon_de_caisses.transport_interne_id',
        'bon_de_caisses.user_id',
        'bon_de_caisses.created_at'
    ])
    ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
    ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
    ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
    ->leftjoin('vehicules', 'bon_de_caisses.vehicule_id', '=', 'vehicules.id')
    ->where(function ($query) {
        $query->where('bon_de_caisses.etape', 'RAF')
              ->orWhere('bon_de_caisses.user_id', Auth::user()->id);
    })
    ->where(function ($query) {
        $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                    ->orWhere('bon_de_caisses.etape', 'like', "%{$this->search}%")
                    ->orWhere('bon_de_caisses.depense', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('transport_internes.numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%")
                    ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%");
    })
    ->orderBy('bon_de_caisses.created_at', 'DESC')
    ->paginate(10, '*', 'bons-pagination');        
   
}
else if (Auth::user()->can('Payer bon de caisse')){

    $bonsDeCaisse = BonDeCaisse::select([
        'bon_de_caisses.id',
        'bon_de_caisses.numero',
        'bon_de_caisses.montant_definitif',
        'bon_de_caisses.depense',
        'bon_de_caisses.etape',
        'bon_de_caisses.rejected',
        'bon_de_caisses.dossier_id',
        'bon_de_caisses.vehicule_id',
        'bon_de_caisses.transport_interne_id',
        'bon_de_caisses.bon_de_caisses.user_id',
        'bon_de_caisses.created_at'
    ])
    ->leftjoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
    ->leftjoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
    ->leftjoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
    ->leftjoin('vehicules', 'bon_de_caisses.vehicule_id', '=', 'vehicules.id')
    ->where(function ($query) {
        $query->where('bon_de_caisses.etape', 'CAISSE')
              ->orWhere('bon_de_caisses.user_id', Auth::user()->id);
    })
    ->where(function ($query) {
        $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                    ->orWhere('bon_de_caisses.etape', 'like', "%{$this->search}%")
                    ->orWhere('bon_de_caisses.depense', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('transport_internes.numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%")
                    ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%");
    })
    ->orderBy('bon_de_caisses.created_at', 'DESC')
    ->paginate(10, '*', 'bons-pagination');        
   
}else{
    $bonsDeCaisse = BonDeCaisse::select([
        'bon_de_caisses.id',
        'bon_de_caisses.numero',
        'bon_de_caisses.montant_definitif',
        'bon_de_caisses.depense',
        'bon_de_caisses.etape',
        'bon_de_caisses.rejected',
        'bon_de_caisses.dossier_id',
        'bon_de_caisses.transport_interne_id',
        'bon_de_caisses.vehicule_id',
        'bon_de_caisses.user_id',
        'bon_de_caisses.created_at'
    ])
    ->leftJoin('users', 'bon_de_caisses.user_id', '=', 'users.id')
    ->leftJoin('dossiers', 'bon_de_caisses.dossier_id', '=', 'dossiers.id')
    ->leftJoin('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
    ->leftjoin('vehicules', 'bon_de_caisses.vehicule_id', '=', 'vehicules.id')
    ->where('bon_de_caisses.user_id', Auth::user()->id)
    ->where(function ($query) {
        $query->where('bon_de_caisses.numero', 'like', "%{$this->search}%")
                    ->orWhere('bon_de_caisses.etape', 'like', "%{$this->search}%")
                    ->orWhere('bon_de_caisses.depense', 'like', "%{$this->search}%")
                    ->orWhere('dossiers.numero', 'like', "%{$this->search}%")
                    ->orWhere('transport_internes.numero', 'like', "%{$this->search}%")
                    ->orWhere('users.name', 'like', "%{$this->search}%")
                    ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%");
    })
    ->orderBy('bon_de_caisses.created_at', 'DESC')
    ->paginate(10, '*', 'bons-pagination');         
}