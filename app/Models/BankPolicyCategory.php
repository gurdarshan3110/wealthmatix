<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankPolicyCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bank_policy_id',
        'category_id',
        'status'
    ];

    public function bankPolicy()
    {
        return $this->belongsTo(BankPolicy::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
