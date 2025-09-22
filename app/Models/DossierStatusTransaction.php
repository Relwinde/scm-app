<?php

namespace App\Models;

use App\Models\DossierStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DossierStatusTransaction extends Model
{
    use HasFactory;

    protected $table = 'dossier_status_transactions';
    protected $guarded = [];


    public function fromStatus()
    {
        return $this->belongsTo(DossierStatus::class, 'from_status_id');
    }

    public function toStatus()
    {
        return $this->belongsTo(DossierStatus::class, 'to_status_id');
    }
}
