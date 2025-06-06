<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierMarchandise extends Model
{
    use HasFactory;

    protected $fillable = [
        'dossier_id',
        'marchandise_id'
    ];

    protected $table = 'dossier_marchandise';
}
