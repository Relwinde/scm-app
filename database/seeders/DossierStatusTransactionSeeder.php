<?php

namespace Database\Seeders;

use App\Models\DossierStatusTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DossierStatusTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the status transitions
        // $transitions = [
        //     ['from_status_id' => 1, 'to_status_id' => 2], // Saisie -> Codifié
        //     ['from_status_id' => 2, 'to_status_id' => 3], // Codifié -> FM Provisoire
        //     ['from_status_id' => 3, 'to_status_id' => 4], // FM Provisoire -> FM Définitive
        //     // Add more transitions as needed
        // ];

        // foreach ($transitions as $transition) {
        //     \App\Models\DossierStatusTransaction::create($transition);
        // }

        DossierStatusTransaction::create([
            'from_status_id' => 1, // Saisie
            'to_status_id' => 2    // Codifié
        ]);
        DossierStatusTransaction::create([
            'from_status_id' => 2, // Codifié
            'to_status_id' => 3    // FM Provisoire
        ]);
        DossierStatusTransaction::create([
            'from_status_id' => 3, // FM Provisoire
            'to_status_id' => 4    // FM Définitive
        ]);
         DossierStatusTransaction::create([
            'from_status_id' => 3, // FM Définitive
            'to_status_id' => 5    // Enregistré & Déposé
        ]);
        DossierStatusTransaction::create([
            'from_status_id' => 4, // FM Définitive
            'to_status_id' => 5    // Enregistré & Déposé
        ]);
         DossierStatusTransaction::create([
            'from_status_id' => 5, // Enregistré & Déposé
            'to_status_id' => 6    // BAE
        ]);
    }
}
