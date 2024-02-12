<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'profile_picture',
        'email', 
        'phone_no', 
        'address', 
        'suburb', 
        'state', 
        'postcode', 
        'status', 
    ];

    protected $appends = [
        'media'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'customer_user');
    }

    public function getMediaAttribute()
    {
        if($this->profile_picture!==null){
            return Media::where('id', $this->profile_picture)->first()->file_path;
        }
        return null;
    }

}
