<?php

namespace App\Models\Finance\Commande;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCommande extends Model
{
    use HasFactory;
    protected $fillable = ['media', 'user', 'commande'];
    protected $table = 'medias_commandes';
    public function commandeLinked()
    {
        return $this->belongsTo(CommandeSimple::class, 'commande');
    }

    public function ustilisateur()
    {
        return $this->hasOne(User::class, 'user');
    }
}
