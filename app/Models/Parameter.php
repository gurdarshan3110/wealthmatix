<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'logo',
        'primary',
        'status',
    ];

    // Define relationship with Media model assuming 'media' table exists
    public function logoMedia()
    {
        return $this->belongsTo(Media::class, 'logo');
    }

    public function bankPolicies()
    {
        return $this->belongsToMany(BankPolicy::class, 'bank_policy_parameters')
                    ->withPivot('start', 'end')
                    ->withTimestamps();
    }
    
}
