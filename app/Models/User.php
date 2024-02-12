<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public const USER_SUPER_ADMIN = 'super_admin';

    public const USER_EMPLOYEE = 'employee';

    public const USER_CUSTOMER = 'customer';

    public const USER_SUPPLIER = 'supplier';

    protected $fillable = [
        'name', 'email', 'phone_no', 'password', 'user_type', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'user_supplier');
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_user');
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_user');
    }
}
