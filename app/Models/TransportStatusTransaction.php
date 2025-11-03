<?php

namespace App\Models;

use App\Models\TransportStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransportStatusTransaction extends Model
{
    use HasFactory;


    public function fromStatus()
    {
        return $this->belongsTo(TransportStatus::class, 'from_status_id');
    }

    public function toStatus()
    {
        return $this->belongsTo(TransportStatus::class, 'to_status_id');
    }
}
