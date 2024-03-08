<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agent_code',
        'name',
        'phone_no',
        'email',
        'residential_address',
        'office_address',
        'city',
        'state',
        'gst_no',
        'account_no',
        'ifsc',
        'bank',
        'branch',
        'pan',
        'pan_id',
        'aadhar',
        'aadhar_id',
        'bank_cancel_cheque',
        'agency_id',
        'status',
    ];

    public function panMedia()
    {
        return $this->belongsTo(Media::class, 'pan');
    }

    public function aadharMedia()
    {
        return $this->belongsTo(Media::class, 'aadhar');
    }

    public function chequeMedia()
    {
        return $this->belongsTo(Media::class, 'bank_cancel_cheque');
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

}
