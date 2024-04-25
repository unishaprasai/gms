<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class MemberAttendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'attendance_date',
        'status',
    ];

    public function members(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
    // public function member()
    // {
    //     return $this->belongsTo(Members::class);
    // }

    public function member()
    {
        return $this->belongsTo(Members::class, 'id');
    }
}
