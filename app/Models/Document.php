<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function bon_de_caisse(){
        return $this->belongsTo(BonDeCaisse::class, 'bon_de_caisse_id');
    }

    public function transport_interne(){
        return $this->belongsTo(TransportInterne::class, 'transport_interne_id');
    }

    public function dossier(){
        return $this->belongsTo(Dossier::class, 'dossier_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
