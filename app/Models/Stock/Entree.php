<?php

namespace App\Models\Stock;

use App\Models\Finance\Commande\CommandeSimple;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Entree extends Model
{
    protected $fillable = ['commande', 'status', 'code', 'user'];
    protected $dates = ['created_at'];

    const RULES = [
        'commande' => 'required',
    ];

    public function genererCode(): void
    {
        $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chiffres = '0123456789';
        $this->attributes['code'] = 'ENT' . substr(str_shuffle($lettres), 0, 3) . \substr(\str_shuffle($chiffres), 0, 4);
    }

    public function commandeLinked()
    {
        return $this->belongsTo(CommandeSimple::class, 'commande');
    }

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function medias()
    {
        return $this->hasMany(MediaEntree::class, 'entree');
    }

    public function pieces()
    {
        return $this->belongsToMany(Piece::class, 'pieces_entrees', 'entree', 'piece')->using(PieceEntree::class)
            ->withPivot('quantite', 'vehicule')
            ->withTimestamps();
    }
}
