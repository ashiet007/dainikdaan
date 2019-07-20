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
        'name', 'email', 'password','user_name','status','sponsor_id','identity','pool_no'
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

    public function userBonus()
    {
        return $this->hasMany('App\UserFund','user_id');
    }

    public function userPreStatus()
    {
        return $this->hasOne('App\UserPreStatus','user_id');
    }

    public function singleLineIncome()
    {
        return $this->hasOne('App\CompanyPool','user_id');
    }

    /************ Scopes *************/
    public function scopeReal($query)
    {
        return $query->where('identity','real');
    }

    public function scopePending($query)
    {
        return $query->where('status','pending');
    }

    public function scopeActive($query)
    {
        return $query->where('status','active');
    }

    public function scopeBlocked($query)
    {
        return $query->where('status','blocked');
    }

    public function scopeRejected($query)
    {
        return $query->where('status','rejected');
    }

    /*********** Queries ********************/

    public function getUserDetails($userId)
    {
        return $this->with('userDetails.userState','userDetails.userDistrict','userDetails.userBank')                    ->where('id',$userId)
                    ->first();
    }

    public function getSponsorDetails($sponsorId)
    {
        return $this->with('userDetails')
                    ->where('user_name',$sponsorId)
                    ->first();
    }

    public function getRegisteredUser($username)
    {
        return $this->with('userDetails.userState','userDetails.userDistrict')
                    ->where('sponsor_id',$username)
                    ->pending()
                    ->real()
                    ->get();
    }

    public function getActiveUser($username)
    {
        return $this->with('userDetails.userState','userDetails.userDistrict')
                    ->where('sponsor_id',$username)
                    ->active()
                    ->real()
                    ->get();
    }

}

