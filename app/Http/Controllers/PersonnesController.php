<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;

class PersonnesController extends Controller
{
    public function index()
    {

    }

    public function add()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit(int $id)
    {

    }

    public function update(Request $request)
    {

    }

    public function delete(int $id)
    {

    }

    public function findjs($contact)
    {
        $personne = Personne::orWhere('telephone', $contact)->orWhere('contact_entreprise', $contact)->orWhere('contact_assurance', $contact)->get()->first();
        $nature = null;
        if (!empty($personne)) {
            $nature = $personne->nature();
        } else {
            $personne = false;
        }
        return response()->json(['personne' => $personne, 'nature' => $nature]);
    }

    public function storejs(Request $request)
    {
        $request->validate(Personne::RULES);
        $personne = new Personne($request->all());
        $personne->immatriculer();
        $personne->save();
        $message = 'le client a été crée avec succès';
        return response()->json(['message' => $message]);
    }
}
