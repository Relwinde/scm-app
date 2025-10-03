<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\DossierStatus;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\DossierStatusTransaction;

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
        DossierStatus::create([
            'name' => 'RE Reçue',
            'code' => 'rep_exo'
        ]);
        $this->call(DossierStatusTransactionSeeder::class);
        Permission::create(['name'=> 'Confirmer une feuille minute']);
        Permission::create(['name'=> 'Modifier une feuille minute confirmée']);
        Permission::create(['name'=>'Enregistrer & déposer dossiers en douane']);
        Permission::create(['name'=>'Charger le BAE']);
        Permission::create(['name'=>'Charger les bordereaux de livraison signés']);
        Permission::create(['name'=> 'Renseigner la base d\'imputation']);
        Permission::create(['name'=> 'Déposer le DI']);
        Permission::create(['name'=> 'Confirmer la reponse de la DE']);

        // DossierStatusTransaction::create([
        //     'from_status_id' => DossierStatus::where('code', 'di_dep')->first()->id,
        //     'to_status_id' => DossierStatus::where('code', 'rep_exo')->first()->id
        // ]);
        // DossierStatusTransaction::create([
        //     'from_status_id' => DossierStatus::where('code', 'rep_exo')->first()->id,
        //     'to_status_id' => DossierStatus::where('code', 'eng_dep')->first()->id
        // ]);

    }
}
