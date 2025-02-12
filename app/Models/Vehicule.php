<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function bonDeCaisses (){
        return $this->hasMany(BonDeCaisse::class);
    }
}
