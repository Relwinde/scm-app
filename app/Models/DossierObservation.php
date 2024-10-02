<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierObservation extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table ='dossier_observation';
}
