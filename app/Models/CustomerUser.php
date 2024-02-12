<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
    ];
}
