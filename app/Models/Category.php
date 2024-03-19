<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'logo',
        'status',
    ];

    // Define relationship with Media model assuming 'media' table exists
    public function logoMedia()
    {
        return $this->belongsTo(Media::class, 'logo');
    }
}
