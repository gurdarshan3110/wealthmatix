<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariantMrn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'variant_mrn'; // Specify the correct table name if different

    protected $fillable = [
        'variant_id', 'mrn_id', 'quantity', 'mrp','unit_price','sale_price', 'status','expiry_date', 'manufacture_date',
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

    public function mrn()
    {
        return $this->belongsTo(MRN::class);
    }
}
