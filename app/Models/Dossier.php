<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Marchandise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dossier extends Model
{
    use HasFactory;
    use SoftDeletes;
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

    public function bureau_de_douane(){
        return $this->belongsTo(BureauDeDouane::class);
    }

}
