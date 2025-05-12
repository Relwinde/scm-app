<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarchandiseTransportInterne extends Model
{
    use HasFactory;
    protected $table = 'marchandise_transport_interne';

    protected $fillable = [
        'transport_interne_id',
        'marchandise_id'
    ];
}
