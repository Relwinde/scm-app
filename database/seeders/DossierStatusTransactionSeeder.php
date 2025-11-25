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
            'to_status_id' => DossierStatus::where('code', 'lvr')->first()->id    // Livré
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

        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'lvr')->first()->id, // Livré
            'to_status_id' => DossierStatus::where('code', 'tr_fact')->first()->id    // Transmis pour facturation
        ]);

        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'tr_fact')->first()->id, // Transmis pour facturation 
            'to_status_id' => DossierStatus::where('code', 'fact')->first()->id    // Facturé
        ]);

        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'fact')->first()->id, // Facturé
            'to_status_id' => DossierStatus::where('code', 'pay')->first()->id    // Payé
        ]);

        DossierStatusTransaction::create([
            'from_status_id' => DossierStatus::where('code', 'pay')->first()->id, // Payé
            'to_status_id' => DossierStatus::where('code', 'arch')->first()->id    // Archivé
        ]);

    }
}
