<?php

namespace Database\Seeders;

use App\Models\TransportStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransportStatus::create([
            'name' => 'Saisi',
            'code' => 'ssi'
        ]);
        TransportStatus::create([
            'name' => 'En cours de livraison',
            'code' => 'ecl'
        ]);
        TransportStatus::create([
            'name' => 'Livré',
            'code' => 'lvr'
        ]);

        TransportStatus::create([
            'name' => 'Transmis pour facturation',
            'code' => 'tr_fact'
        ]);

        TransportStatus::create([
            'name' => 'Facturé',
            'code' => 'fact'
        ]);

        TransportStatus::create([
            'name' => 'Payé',
            'code' => 'pay'
        ]);

        TransportStatus::create([
            'name' => 'Archivé',
            'code' => 'arch'
        ]);
    }
}
