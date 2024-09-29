<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Chauffeur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransportInterne extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function chauffeur(){
        return $this->belongsTo(Chauffeur::class);
    }
    public function vehicule(){
        return $this->belongsTo(Vehicule::class);
    }

}
