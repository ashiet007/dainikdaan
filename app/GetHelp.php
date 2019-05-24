<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class GetHelp extends Model
{
    protected $table = 'get_helps';

    protected $guarded = [];

    public function giveHelps()
    {
        return $this->belongsToMany('App\GiveHelp','give_get_helps')->withPivot('assigned_amount','proof_file_name','status','extend_timer_count')->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}