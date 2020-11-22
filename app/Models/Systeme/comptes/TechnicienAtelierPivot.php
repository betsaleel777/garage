<?php
namespace App\Models\Systeme\Comptes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnicienAtelierPivot extends Model
{
    use HasFactory;
    protected $fillable = ['atelier', 'technicien'];
}
