<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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

        $this->call(DossierStatusSeeder::class);
        $this->call(DossierStatusTransactionSeeder::class);
    }
}
