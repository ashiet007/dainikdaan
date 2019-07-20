<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class CompanyPool extends Model
{
    protected $table = 'company_pool';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function scopeStart($query)
    {
        return $query->where('status','start');
    }
}