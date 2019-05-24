<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'banks';

    public function userDetails()
    {
        $this->belongsTo('App\UserDetail','bank_id');
    }
}
