<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $fillable = ['item_id', 'category_id', 'sub_category_id'];

    // Define relationships with other models
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
