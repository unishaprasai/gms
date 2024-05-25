<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $fillable = ['member_id', 'amount', 'payment_date', 'status', 'payment_mode', 'membership_type'];

}
