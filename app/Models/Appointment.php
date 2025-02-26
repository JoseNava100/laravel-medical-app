<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'date_time',
        'status',
        'notes',
    ];

    protected $table = 'appointments';

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
