<?php

namespace App\Livewire\Layout;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{

    public $bonManager; 
    public $bonRaf; 
    public $bonCaisse;

    public function mount(){
        $this->bonManager = Auth::user()->bonDeCaisses()->where('bon_de_caisses.etape', 'MANAGER')->count();
        $this->bonRaf = Auth::user()->bonDeCaisses()->where('bon_de_caisses.etape', 'RAF')->count();
        $this->bonCaisse = Auth::user()->bonDeCaisses()->where('bon_de_caisses.etape', 'CAISSE')->count();
    }
    public function render()
    {
        return view('livewire.layout.notifications');
    }

    public function notify (){
        if (
                Auth::user()->bonDeCaisses()->where('etape', 'MANAGER')->count() != $this->bonManager ||
                Auth::user()->bonDeCaisses()->where('etape', 'RAF')->count() != $this->bonRaf ||
                Auth::user()->bonDeCaisses()->where('etape', 'CAISSE')->count() != $this->bonCaisse
            ){
                
                $this->bonManager = Auth::user()->bonDeCaisses()->where('bon_de_caisses.etape', 'MANAGER')->count();
                $this->bonRaf = Auth::user()->bonDeCaisses()->where('bon_de_caisses.etape', 'RAF')->count();
                $this->bonCaisse = Auth::user()->bonDeCaisses()->where('bon_de_caisses.etape', 'CAISSE')->count();      
                $this->dispatch('notificator'); 
        }
        
    }
}
