<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    public const STOCK_TYPE_IN = 'In';
    public const STOCK_TYPE_IN_VAL = 0;

    public const STOCK_TYPE_ISSUED = 'Issued';
    public const STOCK_TYPE_ISSUES_VAL = 1;

    public const STOCK_TYPE_SOLD = 'Sold';
    public const STOCK_TYPE_SOLD_VAL = 2;

    public const STOCK_TYPE_RETURN = 'Return';
    public const STOCK_TYPE_RETURN_VAL = 3;

    public const STOCK_TYPE_LOST = 'Lost';
    public const STOCK_TYPE_LOST_VAL = 4;

    public const STOCK_TYPE_DAMAGED = 'Damaged';
    public const STOCK_TYPE_DAMAGED_VAL = 5;

    public const STOCK_STATUS_ACTIVE = 'Active';
    public const STOCK_STATUS_ACTIVE_VAL = 1;

    public const STOCK_STATUS_DEACTIVE = 'De-Active';
    public const STOCK_STATUS_DEACTIVE_VAL = 0;

    public const STOCK_STATUS_INTRANSIT = 'In Transit';
    public const STOCK_STATUS_INTRANSIT_VAL = 2;

    protected $fillable = [
        'variant_id',
        'store_id',
        'batch_no',
        'unit_price',
        'sale_price',
        'mrp',
        'quantity',
        'type',
        'expiry_date',
        'manufacture_date',
        'action_date',
        'status',
        'transfered_to',
        'sold_to'
    ];

    protected $appends = [
        'type_value','status_value','actual_quantity'
    ];


    /**
     * Get the variant attribute for the inventory.
     */
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    /**
     * Get the store for the inventory.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getTypeValueAttribute()
    {

        switch ($this->type) {
            case '0':
                return Inventory::STOCK_TYPE_IN;
                break;
            case '1':
                return Inventory::STOCK_TYPE_ISSUED;
                break;
            case '2':
                return Inventory::STOCK_TYPE_SOLD;
                break;
            case '3':
                return Inventory::STOCK_TYPE_RETURN;
                break;
            case '4':
                return Inventory::STOCK_TYPE_LOST;
                break;
            case '5':
                return Inventory::STOCK_TYPE_DAMAGED;
                break;
        }
    }

    public function getStatusValueAttribute()
    {

        switch ($this->status) {
            case '1':
                return Inventory::STOCK_STATUS_ACTIVE;
                break;
            case '0':
                return Inventory::STOCK_STATUS_DEACTIVE;
                break;
            case '2':
                return Inventory::STOCK_STATUS_INTRANSIT;
                break;
        }
    }

    public function getActualQuantityAttribute()
    {
        $storeId = session('store_id');

        // Check if store_id is set in the session and is a positive integer
        if ($storeId && is_numeric($storeId) && $storeId > 0) {
            // Calculate and return the sum of quantities for the variant and store
            return Inventory::where('variant_id', $this->variant_id)
                ->where('store_id', $storeId)
                ->where('status','!=', Inventory::STOCK_STATUS_DEACTIVE_VAL)
                ->sum('quantity');
        }

        // Default to 0 if store_id is not valid
        return 0;

    }

}
