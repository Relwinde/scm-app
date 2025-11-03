<?php

namespace App\Livewire;

use App\Models\Dossier;
use Livewire\Component;
use App\Models\DossierStatus;
use App\Models\TransportStatus;
use App\Models\TransportInterne;

class Home extends Component
{
    public function render()
    {
        $fm_prov = Dossier::where('dossier_status_id', DossierStatus::where('code', 'fm_prov')->first()->id)->count();

        $dep = Dossier::where('dossier_status_id', DossierStatus::where('code', 'fm_def')->first()->id)->count();

        $dem_exo = Dossier::where('dossier_status_id', DossierStatus::where('code', 'di_dep')->first()->id)->count();

        $bae = Dossier::where('dossier_status_id', DossierStatus::where('code', 'bae')->first()->id)->count() + TransportInterne::where('transport_status_id',  TransportStatus::where('code', 'ecl')->first()->id)->count();

        return view('livewire.home', ['fm_prov'=>$fm_prov, 'dep'=>$dep, 'dem_exo'=>$dem_exo, 'bae'=>$bae]);
    }
}
