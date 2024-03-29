<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'channel_name',
        'channel_code',
        'logo',
        'status',
    ];

    public function logoMedia()
    {
        return $this->belongsTo(Media::class, 'logo');
    }
}
