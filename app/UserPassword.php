<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPassword extends Model
{
    protected $table = 'user_passwords';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
