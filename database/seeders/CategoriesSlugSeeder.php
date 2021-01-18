<?php

namespace Database\Seeders;

use App\Models\Stock\Categorie;
use Illuminate\Database\Seeder;

class CategoriesSlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorie = Categorie::where('id', 13)->get()->first();
        $categorie->slug = 'direction';
        $categorie->save();
        $categorie = Categorie::where('id', 2)->get()->first();
        $categorie->slug = 'freinage';
        $categorie->save();
        $categorie = Categorie::where('id', 3)->get()->first();
        $categorie->slug = 'moteur';
        $categorie->save();
        $categorie = Categorie::where('id', 4)->get()->first();
        $categorie->slug = 'suspension';
        $categorie->save();
        $categorie = Categorie::where('id', 5)->get()->first();
        $categorie->slug = 'cmde-courroie';
        $categorie->save();
        $categorie = Categorie::where('id', 6)->get()->first();
        $categorie->slug = 'préchauffage';
        $categorie->save();
        $categorie = Categorie::where('id', 7)->get()->first();
        $categorie->slug = 'échappement';
        $categorie->save();
        $categorie = Categorie::where('id', 8)->get()->first();
        $categorie->slug = 'filtre';
        $categorie->save();
        $categorie = Categorie::where('id', 9)->get()->first();
        $categorie->slug = 'carrosserie';
        $categorie->save();
        $categorie = Categorie::where('id', 10)->get()->first();
        $categorie->slug = 'amortissement';
        $categorie->save();
        $categorie = Categorie::where('id', 11)->get()->first();
        $categorie->slug = 'nettoyage';
        $categorie->save();
        $categorie = Categorie::where('id', 12)->get()->first();
        $categorie->slug = 'refroidissment';
        $categorie->save();
    }
}
