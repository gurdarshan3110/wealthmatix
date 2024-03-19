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
        'loan_id', 'bank_id', 'category_id', 'policy', 'status'
    ];

    public function parameters()
    {
        return $this->belongsToMany(Parameter::class, 'bank_policy_parameters')
                    ->withPivot('start', 'end')
                    ->withTimestamps();
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
