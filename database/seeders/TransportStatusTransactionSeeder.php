<?php

namespace Database\Seeders;

use App\Models\TransportStatus;
use Illuminate\Database\Seeder;
use App\Models\TransportStatusTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransportStatusTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         TransportStatusTransaction::create([
            'from_status_id' => TransportStatus::where('code', 'ssi')->first()->id, // Saisie
            'to_status_id' => TransportStatus::where('code', 'ecl')->first()->id    // En cours de livraison
        ]);

        TransportStatusTransaction::create([
            'from_status_id' => TransportStatus::where('code', 'ecl')->first()->id, // En cours de livraison
            'to_status_id' => TransportStatus::where('code', 'lvr')->first()->id    // Livré
        ]);
    }
}
