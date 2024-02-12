<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['attribute_id', 'value', 'status'];

    /**
     * Get the attribute that owns the variant attribute.
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
