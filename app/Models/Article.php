<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'fob_devis',
        'fob_xof',
        'fret',
        'autres_frais',
        'assurance',
        'caf',
        'poids_brut',
        'poids_net',
        'quantite_supp',
        'origin',
        'dossier_id',
        'user_id',
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
