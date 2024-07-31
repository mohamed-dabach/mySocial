<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoituresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        


        DB::table('voitures')->updateOrInsert(
            [
                'marque' => 'Ford',
                'modele' => 'Mustang',
            ],
            [
                'annee' => 2021,
                'couleur' => 'Noir',
                'prix' => 50000
            ]
        );
    }
}
