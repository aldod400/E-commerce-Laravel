<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'expiry_date',
        'cvv_code',
        'order_notes',
        'user_id',
    ];
}
