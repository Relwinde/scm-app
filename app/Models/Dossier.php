<?php

namespace App\Models;

use App\Models\Marchandise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function marchandise(){
        return $this->belongsToMany(Marchandise::class);
    }

}
