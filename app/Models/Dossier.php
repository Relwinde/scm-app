<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class);
    }
}
