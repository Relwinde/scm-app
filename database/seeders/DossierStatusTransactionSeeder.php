<?php

namespace Database\Seeders;

use App\Models\DossierStatus;
use Illuminate\Database\Seeder;
use App\Models\DossierStatusTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'from_status_id' => DossierStatus::where('code', 'ssi')->first()->id, // Saisie
            'to_status_id' => DossierStatus::where('code', 'cod')->first()->id    // Codifié
        ]);
        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'cod')->first()->id, // Codifié
            'to_status_id' => DossierStatus::where('code', 'fm_prov')->first()->id    // FM Provisoire
        ]);
        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'fm_prov')->first()->id, // FM Provisoire
            'to_status_id' => DossierStatus::where('code', 'fm_def')->first()->id    // FM Définitive
        ]);
         DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'fm_def')->first()->id, // FM Définitive
            'to_status_id' => DossierStatus::where('code', 'eng_dep')->first()->id    // Enregistré & Déposé
        ]);
        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'fm_def')->first()->id, // FM Définitive
            'to_status_id' => DossierStatus::where('code', 'eng_dep')->first()->id    // Enregistré & Déposé
        ]);
         DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'eng_dep')->first()->id, // Enregistré & Déposé
            'to_status_id' => DossierStatus::where('code', 'bae')->first()->id    // BAE
        ]);
        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'bae')->first()->id, // BAE
            'to_status_id' => DossierStatus::where('code', 'lvr')->first()->id    // En cours de livraison
        ]);


        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'fm_def')->first()->id, // FM Définitive
            'to_status_id' => DossierStatus::where('code', 'ba_imp')->first()->id    // Base d'imputation & Demande d'Exonération
        ]);
        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'ba_imp')->first()->id, // Base d'imputation & Demande d'Exonération
            'to_status_id' => DossierStatus::where('code', 'di_dep')->first()->id    // Dépôt de la demande d'exonération
        ]);
        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'di_dep')->first()->id, // Dépôt de la demande d'exonération
            'to_status_id' => DossierStatus::where('code', 'rep_exo')->first()->id // Reception de la reponse de d'exoneration
        ]);

        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'rep_exo')->first()->id,
            'to_status_id' => DossierStatus::where('code', 'eng_dep')->first()->id
        ]);
    }
}
