<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    public function districts()
    {
        return $this->belongsTo('App\District','district_id');
    }

    public function userDetails()
    {
        return $this->hasMany('App\UserDetail','state_id');
    }
}
