<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiveHelp extends Model
{
    protected $table = 'give_helps';

    protected $guarded = [];

    public function getHelps()
    {
        return $this->belongsToMany('App\GetHelp','give_get_helps')->withPivot('assigned_amount','proof_file_name','status','extend_timer_count')->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
