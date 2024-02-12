<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mrn extends Model
{
    use HasFactory, SoftDeletes;

    public const OUTER_SUPPLIER_TYPE = 'Supplier';
    public const OUTER_SUPPLIER_TYPE_VAL = 0;

    public const INNER_SUPPLIER_TYPE = 'Store';
    public const INNER_SUPPLIER_TYPE_VAL = 1;

    protected $fillable = [
        'mrn_number','batch_no', 'mrn_date', 'user_id', 'supplier_id', 'supplier_type', 'store_id', 'status',
    ];

    protected $casts = [
        'mrn_date' => 'date',
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function variants()
    {
        return $this->hasMany(VariantMrn::class, 'mrn_id');
    }
}
