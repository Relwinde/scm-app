<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
=======
        $this->call(UserSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(CaisseSeeder::class);
        $this->call(BureauDeDouaneSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(VehiculeSeeder::class);
        $this->call(ChauffeurSeeder::class);
>>>>>>> main
    }
}
