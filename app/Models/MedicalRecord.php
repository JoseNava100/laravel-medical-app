<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'diagnosis',
        'treatment',
        'date',
    ];

    protected $table = 'medical_records';

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
