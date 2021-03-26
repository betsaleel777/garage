<?php

namespace App\Http\Controllers\Systeme;

use App\Http\Controllers\Controller;
use App\Models\Systeme\Devise;
use Illuminate\Http\Request;

class DevisesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $devises = Devise::get();
        $titre = 'Devises';
        return view('systeme.devise.index', compact('titre', 'devises'));
    }

    public function add()
    {
        $titre = 'Créer devise';
        return view('systeme.devise.add', compact('titre'));
    }

    public function store(Request $request)
    {
        $request->validate(Devise::RULES);
        $devise = new Devise($request->all());
        $devise->user = session('user_id');
        $devise->save();
        $message = "la devise $devise->nom a été enregistrée avec succès.";
        return redirect()->route('devises')->with('success', $message);
    }

    public function edit(int $id)
    {
        $devise = Devise::find($id);
        $titre = 'Modifier ' . $devise->nom;
        return view('systeme.devise.edit', compact('devise', 'titre'));
    }

    public function update(Request $request)
    {
        $request->validate(Devise::regles($request->devise));
        Devise::where('id', $request->devise)->update($request->except('_token', 'devise'));
        $message = "la devise a été modifiée avec succès";
        return redirect()->route('devises')->with('success', $message);
    }

    public function setCurrent(int $id)
    {
        $devise = Devise::find($id);
        $devise->current = true;
        $devise->save();
        $devises = Devise::where('id', '<>', $id)->get();
        foreach ($devises as $element) {
            if ($element->current) {
                $element->current = false;
                $element->save();
                break;
            }
        }
        $message = "la devise $devise->nom est désormais sélectionnée comme la devise courante de l'application.";
        return redirect()->route('devises')->with('success', $message);
    }
}
