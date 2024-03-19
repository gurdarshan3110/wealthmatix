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

    public const USER_AGENCY = 'agency';

    public const USER_AGENT = 'agent';

    public const USER_CUSTOMER = 'customer';

    protected $fillable = [
        'name', 'email', 'username', 'phone_no', 'password', 'user_type', 'status',
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

    public function agency()
    {
        return $this->hasOneThrough(
            Agency::class,
            AgencyUser::class,
            'user_id',
            'id',
            'id',
            'agency_id'
        );
    }

    public function agents()
    {
        return $this->hasOneThrough(
            Agent::class,
            AgentUser::class,
            'user_id',
            'id',
            'id',
            'agent_id'
        );
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_user');
    }

    public function agencies()
    {
        return $this->belongsToMany(Agency::class, 'agency_user');
    }

    public function agents()
    {
        return $this->belongsToMany(Agent::class, 'agent_user');
    }

    public function agencyId()
    {
        $agency_id = '';
        switch ($this->user_type) {
            case User::USER_SUPER_ADMIN:
                $agency_id = 0;
                break;

            case User::USER_AGENCY:
                $agency_id = $this->agency->id;
                break;

            case User::USER_AGENT:
                $agency_id = $this->agent->agency_id;
                break;

            case User::USER_CUSTOMER:
                $agency_id = $this->customer->agency_id;
                break;
        }

        return $agency_id;
    }

}
