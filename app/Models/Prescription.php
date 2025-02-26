<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    protected $fillable = [
        'appointment_id',
        'medication',
        'dosage',
        'instructions',
    ];

    protected $table = 'prescriptions';

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
