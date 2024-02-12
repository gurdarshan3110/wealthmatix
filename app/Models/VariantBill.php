<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariantBill extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'variant_bill'; // Specify the correct table name if different

    protected $fillable = [
        'variant_id','batch_no', 'bill_id', 'quantity', 'unit_price', 'mrp', 'sale_price', 'status','expiry_date', 'manufacture_date',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    // Relationships

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
