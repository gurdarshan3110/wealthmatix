<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agency_code',
        'name',
        'phone_no',
        'email',
        'address',
        'city',
        'state',
        'gst_no',
        'account_no',
        'ifsc',
        'bank',
        'branch',
        'pan',
        'pan_id',
        'bank_cancel_cheque',
        'status'
    ];

    public function panMedia()
    {
        return $this->belongsTo(Media::class, 'pan');
    }

    public function chequeMedia()
    {
        return $this->belongsTo(Media::class, 'bank_cancel_cheque');
    }
}