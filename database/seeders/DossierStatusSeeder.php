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
            'name' => 'Saisie',
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
    }
}
