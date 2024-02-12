<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'profile_picture',
        'email', 
        'phone_no', 
        'hire_date', 
        'salary', 
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
        return $this->belongsToMany(User::class, 'employee_user');
    }

    public function getMediaAttribute()
    {
        if($this->profile_picture!==null){
            return Media::where('id', $this->profile_picture)->first()->file_path;
        }
        return null;
    }

}
