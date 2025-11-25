<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DossierStatus;
use App\Models\TransportStatus;
use Illuminate\Database\Seeder;
use App\Models\DossierStatusTransaction;
use Spatie\Permission\Models\Permission;
use App\Models\TransportStatusTransaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(UserSeeder::class);
        // $this->call(PermissionsSeeder::class);
        // $this->call(CaisseSeeder::class);
        // $this->call(BureauDeDouaneSeeder::class);
        // $this->call(ClientSeeder::class);
        // $this->call(VehiculeSeeder::class);
        // $this->call(ChauffeurSeeder::class);
        
        // Permission::create(['name'=> 'Voir les depenses sur un véhicule']);
        // Permission::create(['name'=> 'Voir le commentaire de validation du manager']);
        
        // Permission::create(['name'=> 'Etablir la feuille minute']);
        // Permission::create(['name'=> 'Voir les alertes de doublons de bons de caisse']);

        // $this->call(DossierStatusSeeder::class);
        // DossierStatus::create([
        //     'name' => 'RE Reçue',
        //     'code' => 'rep_exo'
        // ]);
        // $this->call(DossierStatusTransactionSeeder::class);
        // Permission::create(['name'=> 'Confirmer une feuille minute']);
        // Permission::create(['name'=> 'Modifier une feuille minute confirmée']);
        // Permission::create(['name'=>'Enregistrer & déposer dossiers en douane']);
        // Permission::create(['name'=>'Charger le BAE']);
        // Permission::create(['name'=>'Charger les bordereaux de livraison signés']);
        // Permission::create(['name'=> 'Renseigner la base d\'imputation']);
        // Permission::create(['name'=> 'Déposer le DI']);
        // Permission::create(['name'=> 'Confirmer la reponse de la DE']);

        // DossierStatusTransaction::create([
        //     'from_status_id' => DossierStatus::where('code', 'di_dep')->first()->id,
        //     'to_status_id' => DossierStatus::where('code', 'rep_exo')->first()->id
        // ]);
        // DossierStatusTransaction::create([
        //     'from_status_id' => DossierStatus::where('code', 'rep_exo')->first()->id,
        //     'to_status_id' => DossierStatus::where('code', 'eng_dep')->first()->id
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


        // 

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


        // Permission Sections
            Permission::create(['name'=> 'Section Transit']);
            Permission::create(['name'=> 'Section Logistique']);

        
        // Permissions Facturation et archivage
            Permission::create(['name'=> 'Tranmettre un dossier pour facturation']);
            Permission::create(['name'=> 'Facturer un dossier']);
            Permission::create(['name'=> 'Valider le paiement d\'un dossier']);
            Permission::create(['name'=> 'Archiver un dossier']);


    }
}
