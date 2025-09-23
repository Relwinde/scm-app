<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepertoireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Models\BureauDeDouane::all() as $bureau) {
            \App\Models\Repertoire::firstOrCreate(
                [
                    'year' => date('Y'),
                    'bureau_de_douane_id' => $bureau->id,
                ],
                [
                    'last_number' => 0,
                ]
            );
        }
    }
}
