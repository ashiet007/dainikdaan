<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';

    protected $fillable = [
        'user_id', 'mob_no', 'alternate_mob_no','bank_id','gpay_no','paytm_no','ifsc_code','branch','account_no','state_id','district_id','account_type'
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function userState()
    {
        return $this->belongsTo('App\State','state_id');
    }

    public function userDistrict()
    {
        return $this->belongsTo('App\District','district_id');
    }
    public function userBank()
    {
        return $this->belongsTo('App\Bank','bank_id');
    }
}
