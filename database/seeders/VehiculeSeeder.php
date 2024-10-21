<?php

namespace Database\Seeders;

use App\Models\Vehicule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehiculeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicule::create([
            'immatriculation'=>'4204F903/4201F903',
            'description'=>'Camion Plateau',
        ]);

        Vehicule::create([
            'immatriculation'=>'4198F903/4198F903',
            'description'=>'Camion Plateau',
        ]);

        Vehicule::create([
            'immatriculation'=>'6321D703/6316D703',
            'description'=>'Camion Plateau',
        ]);

        Vehicule::create([
            'immatriculation'=>'6322D703/8960F503',
            'description'=>'Camion Plateau',
        ]);

        Vehicule::create([
            'immatriculation'=>'9254F503/8967F503',
            'description'=>'Camion Plateau',
        ]);

        Vehicule::create([
            'immatriculation'=>'6074E803/6161E803',
            'description'=>'Porte Char',
        ]);

        Vehicule::create([
            'immatriculation'=>'4725F803',
            'description'=>'Camion Petit Plateau 17T',
        ]);

        Vehicule::create([
            'immatriculation'=>'8970F503',
            'description'=>'Camion 10T',
        ]);

        Vehicule::create([
            'immatriculation'=>'0980D703',
            'description'=>'Camion 10T Avec Grue',
        ]);

        Vehicule::create([
            'immatriculation'=>'4595F903',
            'description'=>'Camionette KIA',
        ]);

        Vehicule::create([
            'immatriculation'=>'1679E503',
            'description'=>'Camionette TOYOTA',
        ]);

        Vehicule::create([
            'immatriculation'=>'6151F503',
            'description'=>'YARIS',
        ]);

        Vehicule::create([
            'immatriculation'=>'0140D703',
            'description'=>'CITROEN',
        ]);

        Vehicule::create([
            'immatriculation'=>'3143F703',
            'description'=>'FORD',
        ]);

        Vehicule::create([
            'immatriculation'=>'0511D703',
            'description'=>'RENAULT KANGOO',
        ]);

    }
}
