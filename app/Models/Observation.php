<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Observation extends Model
{
    // use SoftDeletes;
    use HasFactory;
    protected $guarded = [];

    public function dossiers(){
        return $this->belongsToMany(Dossier::class);
    }
}
