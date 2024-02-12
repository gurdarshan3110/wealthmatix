<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'item_id', 'name', 'unit_id', 'variant_image',  'status'
    ];

    protected $appends = [
        'media'
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

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function mrns()
    {
        return $this->belongsToMany(MRN::class, 'item_mrn')
            ->withPivot('quantity', 'unit_price')
            ->withTimestamps();
    }

    public function media()
    {
        //$mediaIds = explode(',', $this->item_image);

        return Media::whereIn('id', $this->variant_image)->first();
    }

    public function getMediaAttribute()
    {

        if($this->variant_image!==null){
            return Media::where('id', $this->variant_image)->first()->file_path;
        }
        return null;
    }

}
