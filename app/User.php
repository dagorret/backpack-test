<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\CrudTrait; // <--------- this one
use Spatie\Permission\Traits\HasRoles;// <----- and this one

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use CanResetPassword;
    use CrudTrait; // <----- this
    use HasRoles; // <------ and this
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

    public function showRole(){
       return $this->getRoleNames();
    }
}
