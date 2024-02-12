<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number', 'order_date', 'supplier_id', 'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_date' => 'date',
        'status' => 'boolean',
    ];

    // Relationships

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_purchase_order')
            ->withPivot('quantity', 'unit_price')
            ->withTimestamps();
    }
}
