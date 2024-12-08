<?php

namespace Database\Seeders;

use App\Models\BureauDeDouane;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BureauDeDouaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BureauDeDouane::create([
            'nom'=> 'OUAGA ROUTE',
            'code'=> 'BFC04'
        ]);

        BureauDeDouane::create([
            'nom'=> 'OUAGA GARE',
            'code'=>'BFC01'
        ]);

        BureauDeDouane::create([
            'nom'=> 'BUREAU DES EXONERATIONS',
            'code'=>'BFC16'
        ]);

        BureauDeDouane::create([
            'nom'=> 'OUAGA AEROPORT',
            'code'=>'BFC02'
        ]);

        BureauDeDouane::create([
            'nom'=> 'CDP',
            'code'=>'BFC03'
        ]);

        BureauDeDouane::create([
            'nom'=> 'BOBO GARE',
            'code'=>'BFW01'
        ]);

        BureauDeDouane::create([
            'nom'=> 'BANFORA',
            'code'=>'BFW04'
        ]);

        BureauDeDouane::create([
            'nom'=> 'BVA',
            'code'=>'BFC15'
        ]);
    }
}
