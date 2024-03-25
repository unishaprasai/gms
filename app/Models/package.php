<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['package_id','name', 'assign_trainer', 'description', 'price', 'duration_in_days']; // Include fillable attributes
        public function trainer()
    {
        return $this->belongsTo(Trainers::class, 'assign_trainer');
    }
}
