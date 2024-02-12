<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockMovement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id', 'store_id', 'quantity_change', 'movement_type',
        'user_id', 'movement_by', 'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'quantity_change' => 'integer',
        'status' => 'boolean',
    ];

    // Relationships

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class)->withDefault(); // To handle nullable store_id
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault(); // To handle nullable user_id
    }

    public function movementBy()
    {
        return $this->belongsTo(User::class, 'movement_by')->withDefault(); // To handle nullable movement_by
    }
}
