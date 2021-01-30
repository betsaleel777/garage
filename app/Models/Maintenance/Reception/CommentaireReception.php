<?php

namespace App\Models\Maintenance\Reception;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentaireReception extends Model
{
    use HasFactory;
    protected $fillable = ['user', 'contenu', 'reception'];

    public function receptionLinked()
    {
        return $this->belongsTo(Reception::class, 'reception');
    }
}
