<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuiviCaisse extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bon_de_caisse(){
        return $this->belongsTo(BonDeCaisse::class, 'bon_de_caisse_id');
    }

    public function ajustement_bon(){
        return $this->belongsTo(AjustementBon::class, 'ajustement_bon_id');
    }

    public function depot(){
        return $this->belongsTo(Depot::class, 'depot_id');
    }
}
