<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'user_id',
        'date',
        'day_off_status'
    ];

    public function doctor():BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
}
