<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'stores';

    protected $fillable = [
        'name', 'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function stockTransfersFrom()
    {
        return $this->hasMany(StockTransfer::class, 'from_store_id');
    }

    public function stockTransfersTo()
    {
        return $this->hasMany(StockTransfer::class, 'to_store_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
