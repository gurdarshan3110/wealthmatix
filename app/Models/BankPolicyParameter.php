<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankPolicyParameter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bank_policy_id',
        'parameter_id',
        'start',
        'end',
        'status'
    ];

    public function bankPolicy()
    {
        return $this->belongsTo(BankPolicy::class);
    }

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }
}
