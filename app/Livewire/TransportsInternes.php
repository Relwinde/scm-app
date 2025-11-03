<?php

namespace App\Livewire;

use App\Models\Dossier;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\TransportStatus;
use App\Models\TransportInterne;
use Illuminate\Support\Facades\Auth;

class TransportsInternes extends Component
{
    public $search;
    public $selectedStatus = [];

    use WithPagination;

    #[On('new-dossier')]
    #[On('update-dossier')]
    public function render()
    {

        if (! Auth::user()->can('Voir la liste des transports internes')){
            redirect("/");
        }
        $dossiersStatus = TransportStatus::all();

        $dossiers = TransportInterne::select(['transport_internes.id', 'transport_internes.numero', 'transport_internes.client_id', 'transport_internes.chauffeur_id', 'transport_internes.vehicule_id', 'transport_internes.created_at', 'transport_status_id'])
            ->leftjoin('clients', 'transport_internes.client_id', '=', 'clients.id') 
            ->leftjoin('vehicules', 'transport_internes.vehicule_id', '=', 'vehicules.id') 
            ->leftjoin('chauffeurs', 'transport_internes.chauffeur_id', '=', 'chauffeurs.id') 
            ->leftjoin('numero_transports', 'transport_internes.id', '=', 'numero_transports.transport_interne_id') 
            ->where(function ($query){
                $query->where('transport_internes.numero', 'like', "%{$this->search}%")
                ->orWhere('clients.nom', 'like', "%{$this->search}%")
                ->orWhere('chauffeurs.nom', 'like', "%{$this->search}%")
                ->orWhere('vehicules.immatriculation', 'like', "%{$this->search}%")
                ->orWhere('numero_transports.numero', 'like', "%{$this->search}%");

            })
            ->when(collect($this->selectedStatus)->filter()->count() > 0, function ($query) {
                $query->whereIn('transport_internes.transport_status_id', collect($this->selectedStatus)->filter()->all());
            })
            ->orderBy('created_at', 'DESC')
            ->groupBy('numero')
            ->paginate(10, '*', 'dossier-pagination');

            return view('livewire.transports-internes', [
                'dossiers' => $dossiers, 'dossiersStatus' => $dossiersStatus, 'header_title'=>'Dossiers de transports internes', 'create_modal'=>'modals.create-transport-interne', 'button_title'=>'Nouveau dossier'
            ]);
    }

    public function delete (TransportInterne $dossier){

        $bons_dossier = $dossier->bon_de_caisse()->where('deleted_at', NULL)->count();
        if ($bons_dossier > 0){
            $this->dispatch('dossier-delete-error');
        } else {
            $dossier->delete();
            $this->dispatch('dossier-delete-success');
        }
    }
}
