<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bank_id',
        'address',
        'city',
        'sales_manager',
        'sales_manager_email',
        'sales_manager_phone',
        'area_sales_manager',
        'area_sales_manager_email',
        'area_sales_manager_phone',
        'status',
    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
