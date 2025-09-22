<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'dossier_status_history';
    protected $guarded = [];
    
}
