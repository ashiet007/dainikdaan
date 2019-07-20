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

    public function scopePending($query)
    {
        return $query->where('status','pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status','accepted');
    }

    public function scopeWorking($query)
    {
        return $query->where('type','working');
    }

    public function scopeHelping($query)
    {
        return $query->where('type','helping');
    }

    public function scopeNotAssigned($query)
    {
        return $query->where('completion_state','none');
    }

    public function scopePartiallyAssigned($query)
    {
        return $query->where('completion_state', 'partially-assigned');
    }

    public function scopeAssigned($query)
    {
        return $query->where('completion_state', 'assigned');
    }

    public function scopeReport($query,$userId)
    {
        return $query->with('giveHelps.user')
                    ->where('user_id', $userId)
                    ->where(function ($query) {
                        $query->where('completion_state', 'partially-assigned')
                            ->orWhere('completion_state', 'assigned');
                    })
                    ->orderBy('created_at','DESC');
    }

    public function getAssignedHelps($userId)
    {
        return $this->with(['giveHelps.user.userDetails','giveHelps.user.userDetails.userState','giveHelps.user.userDetails.userDistrict','giveHelps' => function ($query) {
                        $query->where('give_get_helps.status', 'pending');
                    }])
                    ->where('user_id', $userId)
                    ->where(function ($query) {
                        $query->where('completion_state', 'partially-assigned')
                            ->orWhere('completion_state', 'assigned');
                    })
                    ->pending()
                    ->orderBy('id','ASC')
                    ->get();
    }

    public function totalHelpingIncome($id)
    {
        return $this->helping()
                    ->accepted()
                    ->where('user_id',$id)
                    ->sum('amount');
    }

    public function lastGetHelp($id)
    {
        return $this->where('user_id',$id)
            ->orderBy('id','DESC')
            ->first();
    }

}