<?php

namespace Database\Seeders;

use App\Models\DossierStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DossierStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DossierStatus::create([
            'name' => 'Saisi',
            'code' => 'ssi'
        ]);
        DossierStatus::create([
            'name' => 'Codifié',
            'code' => 'cod'
        ]);
        DossierStatus::create([
            'name' => 'FM Provisoire',
            'code' => 'fm_prov'
        ]);
        DossierStatus::create([
            'name' => 'FM Définitive',
            'code' => 'fm_def'
        ]);
        DossierStatus::create([
            'name' => 'Enregistré & Déposé',
            'code' => 'eng_dep'
        ]);
        DossierStatus::create([
            'name' => 'Base d\'imputation',
            'code' => 'ba_imp'
        ]);
        DossierStatus::create([
            'name' => 'DE déposée',
            'code' => 'di_dep'
        ]);
        DossierStatus::create([
            'name' => 'RE Reçue',
            'code' => 'rep_exo'
        ]);
        DossierStatus::create([
            'name' => 'En cours de livraison',
            'code' => 'bae'
        ]);
        DossierStatus::create([
            'name' => 'Livré',
            'code' => 'lvr'
        ]);
        // DossierStatus::create([
        //     'name' => 'RE Reçue',
        //     'code' => 'rep_exo'
        // ]);
        DossierStatus::create([
            'name' => 'Transmis pour facturation',
            'code' => 'tr_fact'
        ]);

        DossierStatus::create([
            'name' => 'Facturé',
            'code' => 'fact'
        ]);

        DossierStatus::create([
            'name' => 'Payé',
            'code' => 'pay'
        ]);

        DossierStatus::create([
            'name' => 'Archivé',
            'code' => 'arch'
        ]);

    }
}
