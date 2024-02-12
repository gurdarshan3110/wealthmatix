<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, SoftDeletes;

    public const OUTER_TYPE = 'Customer';
    public const OUTER_TYPE_VAL = 0;

    public const INNER_TYPE = 'Store';
    public const INNER_TYPE_VAL = 1;

    protected $fillable = [
        'bill_number', 'bill_date', 'user_id', 'transfered_to', 'type', 'store_id', 'status',
    ];

    protected $casts = [
        'mrn_date' => 'date',
        'status' => 'boolean',
    ];

    protected $appends = [
        'transfer_to'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getTransferToAttribute(){
        if($this->type==Bill::OUTER_TYPE_VAL){
            return Customer::find($this->transfered_to);
        }else{
            return Store::find($this->transfered_to);
        }
    }

    public function variants()
    {
        return $this->hasMany(VariantBill::class, 'bill_id');
    }
}
