<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierStatus extends Model
{
    use HasFactory;

    protected $table = 'dossier_status';
    protected $guarded = [];
}
