<?php
// app/Models/BankSetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankPolicy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'loan_id',
        'bank_id',
        'policy',
        'status',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function policyMedia()
    {
        return $this->belongsTo(Media::class, 'policy');
    }

    
}
