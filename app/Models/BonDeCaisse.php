<?php

namespace App\Models;

use App\Models\User;
use App\Models\Dossier;
use App\Models\TransportInterne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BonDeCaisse extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function dossier (){
        return $this->belongsTo(Dossier::class, "dossier_id");
    }
    public function transport (){
        return $this->belongsTo(TransportInterne::class, "transport_interne_id");
    }

    public function user (){
        return $this->belongsTo(User::class);
    }

}
