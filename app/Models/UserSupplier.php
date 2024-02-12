<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSupplier extends Model
{
    protected $table = 'user_supplier';

    protected $fillable = [
        'user_id', 'supplier_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
