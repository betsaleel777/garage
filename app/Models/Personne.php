<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $fillable = ['matricule', 'nom_complet', 'telephone', 'type', 'qualificatif', 'email',
        'description', 'representant_assurance', 'contact_assurance', 'email_assurance', 'nom_assurance',
        'representant_entreprise', 'contact_entreprise', 'email_entreprise', 'nom_entreprise',
    ];

    const RULES = [
        'nom_complet' => 'nullable',
        'telephone' => 'nullable|numeric|unique:personnes,telephone',
        'email' => 'nullable|email|unique:personnes,email',
        'representant_assurance' => 'nullable',
        'contact_assurance' => 'nullable|numeric|unique:personnes,contact_assurance',
        'email_assurance' => 'nullable|email|unique:personnes,email_assurance',
        'nom_assurance' => 'nullable|unique:personnes,nom_assurance',
        'representant_entreprise' => 'nullable',
        'contact_entreprise' => 'nullable|numeric|unique:personnes,contact_entreprise',
        'email_entreprise' => 'nullable|email|unique:personnes,email_entreprise',
        'nom_entreprise' => 'nullable|unique:personnes,nom_entreprise',
    ];

    public static function regles(int $id)
    {
        return [
            'nom_complet' => 'nullable|alpha',
            'telephone' => 'nullable|numeric|unique:personnes,telephone,' . $id,
            'email' => 'nullable|email|unique:personnes,email,' . $id,
            'representant_assurance' => 'nullable|alpha',
            'contact_assurance' => 'nullable|numeric|unique:personnes,contact_assurance,' . $id,
            'email_assurance' => 'nullable|email|unique:personnes,email_assurance,' . $id,
            'nom_assurance' => 'nullable|alpha|unique:personnes,nom_assurance,' . $id,
            'representant_entreprise' => 'nullable|alpha',
            'contact_entreprise' => 'nullable|numeric|unique:personnes,contact_entreprise,' . $id,
            'email_entreprise' => 'nullable|email|unique:personnes,email_entreprise,' . $id,
            'nom_entreprise' => 'nullable|alpha|unique:personnes,nom_entreprise,' . $id,
        ];
    }

    public function nature()
    {
        if (!empty($this->attributes['nom_assurance'])) {
            return 'assurance';
        } elseif (!empty($this->attributes['nom_entreprise'])) {
            return 'entreprise';
        } elseif (!empty($this->attributes['nom_complet'])) {
            return 'particulier';
        }
    }

    public function immatriculer(): void
    {
        $lettres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chiffres = '0123456789';
        $this->attributes['matricule'] = 'PER' . substr(str_shuffle($lettres), 0, 4) . \substr(\str_shuffle($chiffres), 0, 4);
    }
}
