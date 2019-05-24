<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_name','status','sponsor_id','identity'
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

    public function userDetails()
    {
        return $this->hasOne('App\UserDetail','user_id');
    }
    public function userPassword()
    {
        return $this->hasOne('App\UserPassword','user_id');
    }

    public function giveHelps()
    {
        return $this->hasMany('App\GiveHelp', 'user_id');
    }

    public function getHelps()
    {
        return $this->hasMany('App\GetHelp', 'user_id');
    }

    public function userFunds()
    {
        return $this->hasMany('App\UserFund','user_id');
    }

    public function userPreStatus()
    {
        return $this->hasOne('App\UserPreStatus','user_id');
    }

}

