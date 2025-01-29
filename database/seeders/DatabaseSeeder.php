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
        Permission::create(['name'=> 'Attacher un document à un bon de caisse']);
        Permission::create(['name'=> 'Voir les fichiers joints d\'un bon de caisse']);
    }
}
