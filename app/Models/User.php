<?php

namespace App\Models; 

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Define the key for route model binding.
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    /**
     * Relationship: User belongs to many Roles.
     */
 

    public function roles()
{
    return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
}


    /**
     * Check if the user has any of the given roles.
     *
     * @param array|string $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            return $this->hasRole($roles);
        }
    
        return false;
    }
    
    public function hasRole($role)
    {
        return $this->roles()->where('slug', $role)->exists();
    }
    

    /**
     * Mass-assignable attributes.
     */
    protected $fillable = [
        'name', 'email', 'password', 'pin_code',
    ];

    /**
     * Hidden attributes for arrays.
     */
    protected $hidden = [
        'pin_code', 'password', 'remember_token',
    ];

    /**
     * Cast attributes to native types.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}


