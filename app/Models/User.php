<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',               // User role: CL/ML, RPMO, RPC, Admin, SWO III, RD
        'area_assigned_id',   // Foreign key to cities table
        'contact_number',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Automatically hash passwords when set
     */
    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = bcrypt($password);
        }
    }

    /**
     * Relationship: User belongs to a City (Area Assigned)
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'area_assigned_id');
    }
}
