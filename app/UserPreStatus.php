<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class UserPreStatus extends Model
{
    protected $table = 'user_pre_status';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}