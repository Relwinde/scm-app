<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySlip extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dossier(){
        return $this->belongsTo(Dossier::class);
    }

    
}
