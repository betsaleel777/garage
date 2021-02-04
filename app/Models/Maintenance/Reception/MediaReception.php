<?php

namespace App\Models\Maintenance\Reception;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaReception extends Model
{
    use HasFactory;
    protected $fillable = array('media', 'commentaire');
    const RULES = [
        'media' => 'nullable|mimes:pdf,png,jpeg,jpg',
    ];

    public function commentaireLinked()
    {
        return $this->belongsTo(CommentaireReception::class, 'commentaire');
    }

}
