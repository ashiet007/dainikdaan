<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class DailyGrowth extends Model
{
    protected $table='daily_growths';
    protected $guarded =[];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}