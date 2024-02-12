<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id', 'name', 'tax_detail_id', 'item_image',  'status','hsn_code'
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function taxDetail()
    {
        return $this->belongsTo(TaxDetail::class);
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

        return Media::whereIn('id', $this->item_image)->first();
    }

    public function getMediaAttribute()
    {

        if($this->item_image!==null){
            return Media::where('id', $this->item_image)->first()->file_path;
        }
        return null;
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

}
