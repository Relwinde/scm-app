<?php

namespace App\Models;

use App\Models\BonDeCaisse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChequePayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function bon_de_caisse (){
        return $this->belongsTo(BonDeCaisse::class);
    }
}
