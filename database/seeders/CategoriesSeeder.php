<?php

namespace Database\Seeders;

use App\Models\Stock\Categorie;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::insert([
            ['nom' => 'freinage', 'user' => 1],
            ['nom' => 'moteur', 'user' => 1],
            ['nom' => 'suspension', 'user' => 1],
            ['nom' => 'commande à courroie/chaîne', 'user' => 1],
            ['nom' => 'allumage/préchauffage', 'user' => 1],
            ['nom' => 'echappement', 'user' => 1],
            ['nom' => 'filtre', 'user' => 1],
            ['nom' => 'carrosserie', 'user' => 1],
            ['nom' => 'amortissement', 'user' => 1],
            ['nom' => 'nettoyage des vitres', 'user' => 1],
            ['nom' => 'refroidissement moteur', 'user' => 1],
            ['nom' => 'direction', 'user' => 1],
        ]);
    }
}
