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

        TransportStatusTransaction::create([
            'from_status_id' => TransportStatus::where('code', 'lvr')->first()->id, // Livré
            'to_status_id' => TransportStatus::where('code', 'tr_fact')->first()->id    // Transmis pour facturation
        ]);

        TransportStatusTransaction::create([
            'from_status_id' => TransportStatus::where('code', 'tr_fact')->first()->id, // Transmis pour facturation 
            'to_status_id' => TransportStatus::where('code', 'fact')->first()->id    // Facturé
        ]);

        TransportStatusTransaction::create([
            'from_status_id' => TransportStatus::where('code', 'fact')->first()->id, // Facturé
            'to_status_id' => TransportStatus::where('code', 'pay')->first()->id    // Payé
        ]);

        TransportStatusTransaction::create([
            'from_status_id' => TransportStatus::where('code', 'pay')->first()->id, // Payé
            'to_status_id' => TransportStatus::where('code', 'arch')->first()->id    // Archivé
        ]);
    }
}
