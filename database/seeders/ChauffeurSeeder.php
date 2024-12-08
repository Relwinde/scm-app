<?php

namespace Database\Seeders;

use App\Models\Chauffeur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChauffeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chauffeur::create([
            'nom'=>'KABORE SALIF'
        ]);

        Chauffeur::create([
            'nom'=>'KABORE YOUNOUSSA'
        ]);

        Chauffeur::create([
            'nom'=>'OUEDRAOGO YASSIA'
        ]);

        Chauffeur::create([
            'nom'=>'YOUGBARE HAMED'
        ]);

        Chauffeur::create([
            'nom'=>'KONOMBO ABLASSE'
        ]);

        Chauffeur::create([
            'nom'=>'TIEMTORE EMMANUEL'
        ]);

        Chauffeur::create([
            'nom'=>'OUATTARA OUMAR'
        ]);

         Chauffeur::create([
            'nom'=>'SANKARA MADI'
        ]);


    }
}
