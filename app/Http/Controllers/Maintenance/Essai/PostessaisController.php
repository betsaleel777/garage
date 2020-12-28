<?php

namespace App\Http\Controllers\Maintenance\Essai;

use App\Http\Controllers\Controller;
use App\Models\Maintenance\Essai\Postessai;
use App\Models\Maintenance\Reception\Reception;
use App\Models\Maintenance\Reparation\Reparation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostessaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function updateDependances($reception, $accepter)
    {
        if ($accepter) {
            $reception->statut = 'réparé';
            $reparation = Reparation::find($reception->reparation->id);
            $reparation->couleur = 'green';
            $reception->save();
            $reparation->save();
        } else {
            $reception->statut = 'réparation rejétée';
            $reparation = Reparation::find($reception->reparation->id);
            $reparation->couleur = 'red';
            $reception->save();
            $reparation->save();
        }
    }

    public static function decompte()
    {
        session()->put('reparations', Reparation::notFinished()->get()->count());
        session()->put('essais', Reception::preEssayable()->get()->count() + Reception::postEssayable()->get()->count());
    }

    public function liste()
    {
        $receptions = Reception::with('utilisateur', 'postessai', 'reparation.finished')->orderBy('id', 'desc')->postEssayableAdmin()->get();
        //retirer les reception déjà liée à un postessai
        $titre = 'Essais après réparations';
        return view('maintenance.essais.post.liste', compact('titre', 'receptions'));
    }

    public function store(Request $request)
    {
        $request->validate(Postessai::RULES);
        $post = new Postessai($request->all());
        $post->user = Auth::id();
        $post->save();
        $reception = Reception::with('reparation')->find($request->reception);
        self::updateDependances($reception, $request->accepter);
        self::decompte();
        return;
    }

    public function update(Request $request)
    {
        $request->validate(Postessai::RULES);
        $reception = Reception::with('reparation', 'postessai')->find($request->reception);
        $post = Postessai::where('id', $reception->postessai->id)->update($request->all());
        self::updateDependances($reception, $request->accepter);
        self::decompte();
        return;
    }

    public function valider(int $id)
    {
        $post = Postessai::find($id);
        $post->valider();
        $post->save();
        $message = "Essais avant réparation validé avec succès";
        return redirect()->route('postessai_liste')->with('success', $message);
    }
}
