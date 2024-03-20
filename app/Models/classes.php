<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    protected $fillable = ['ClassName', 'trainersid', 'shift', 'class_time', 'venue']; // Include 'venue' attribute

    public function trainer()
    {
        return $this->belongsTo(Trainers::class, 'trainersid');
    }
}
