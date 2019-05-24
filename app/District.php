<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    public function state()
    {
        return $this->hasOne('App\State','district_id');
    }

    public function userDetails()
    {
        return $this->hasMany('App\UserDetail','district_id');
    }


}