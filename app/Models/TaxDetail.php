<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'rate', 'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'rate' => 'decimal:2',
        'status' => 'boolean',
    ];

    // Add any additional methods or relationships here
}
