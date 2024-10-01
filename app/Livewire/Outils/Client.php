<?php

namespace App\Livewire\Outils;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Client as ModelsClient;

class Client extends Component
{

    public $search;

    use WithPagination;

    #[On('new-client')]
    public function render()
    {

        $clients = ModelsClient::select(['id', 'nom', 'telephone', 'email', 'adresse', 'ifu', 'rccm'])
            ->where('nom', 'like', "%{$this->search}%")
            ->orWhere('telephone', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->orWhere('adresse', 'like', "%{$this->search}%")
            ->orWhere('ifu', 'like', "%{$this->search}%")
            ->orWhere('rccm', 'like', "%{$this->search}%")
            ->orderBy('created_at', 'DESC')
            ->paginate(10, '*', 'vehicule-pagination');
            
        return view('livewire.outils.client',['clients'=>$clients, 'header_title'=>'Liste des clients', 'create_modal'=>'modals.outils.create-client', 'button_title'=>'Nouveau client']);
    }
}
