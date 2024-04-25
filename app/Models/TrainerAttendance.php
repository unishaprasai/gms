<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class TrainerAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'trainer_id', // Add trainer_id to the fillable array
        'attendance_date',
        'status',
    ];
    public function trainers(): BelongsTo
    {
        return $this->belongsTo(User::class, 'trainer_id', 'id');
    }
    // public function trainer()
    // {
    //     return $this->belongsTo(Trainers::class);
    // }

    public function trainer()
    {
        return $this->belongsTo(Trainers::class, 'trainer_id');
    }
}
