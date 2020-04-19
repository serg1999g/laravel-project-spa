<?php

namespace Modules\Auth\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Mission\Models\Mission;

class User extends Authenticatable
{
    use hasApiTokens, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    ];
    /**
     * @var mixed
     */
    private $roles;


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    /**
     * assign a role during user registration
     *
     * @param Role $role
     * @return mixed
     */
    public function assingRole(Role $role)
    {
        return $this->roles()->save($role);
    }


    /**
     * Check if the current logged in user has a role
     *
     * @param mixed ...$roles
     * @return bool
     */
    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('slug', $role)) {
                return true;
            }
        }
        return false;
    }
}
