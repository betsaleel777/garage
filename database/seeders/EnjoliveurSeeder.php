<?php

namespace Database\Seeders;

use App\Models\Maintenance\Reception\Enjoliveur;
use Illuminate\Database\Seeder;

class EnjoliveurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enjoliveur::insert([['nom' => 'AVG'], ['nom' => 'AVD'], ['nom' => 'ARG'], ['nom' => 'ARD']]);
    }
}
