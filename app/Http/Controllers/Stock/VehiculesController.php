<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Systeme\Vehicule;
use Illuminate\Http\Request;

class VehiculesController extends Controller
{
    public function storejs(Request $request)
    {
        $request->validate(Vehicule::RULES);
        $vehicule = new Vehicule($request->all());
        $vehicule->user = session('user_id');
        $vehicule->makeName();
        $vehicule->save();
        $message = "le vehicule $vehicule->designation a été enregistrée avec succès.";
        return response()->json(['message' => $message]);
    }

    public function getAll()
    {
        $data = Vehicule::get();
        $vehicules = array_map(function ($vehicule) {
            return ['label' => $vehicule->designation, 'code' => $vehicule->id];
        }, $data->all());
        return response()->json(['vehicules' => $vehicules]);
    }

    public function getVehicule(int $id)
    {
        $vehicule = Vehicule::find($id);
        return response()->json(['vehicule' => $vehicule]);
    }
}
