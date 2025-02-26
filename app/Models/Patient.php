<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'birthdate',
        'weight',
        'height',
        'allergies',
        'Nationality',
        'gender',
    ];

    protected $table = 'patients';

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
