<?php

namespace App\Models;

use App\Models\Dossier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marchandise extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function dossiers(){
        return $this->belongsToMany(Dossier::class);
    }
}
