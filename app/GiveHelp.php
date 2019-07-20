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

    public function scopeHelping($query)
    {
        return $query->where('type','helping');
    }

    public function scopePending($query)
    {
        return $query->where('status','pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status','rejected');
    }

    public function scopeNotAssigned($query)
    {
        return $query->where('completion_state','none');
    }

    public function scopeReport($query,$userId)
    {
        return $query->with('getHelps.user')
                    ->where('user_id', $userId)
                    ->where(function ($query) {
                        $query->where('completion_state', 'partially-assigned')
                            ->orWhere('completion_state', 'assigned');
                    })
                    ->orderBy('created_at','DESC');
    }

    public function getAssignedHelps($userId)
    {
        return $this->with('getHelps.user.userDetails.userBank','getHelps.user.userDetails.userState','getHelps.user.userDetails.userDistrict')
            ->where('user_id', $userId)
            ->where(function ($query) {
                $query->where('completion_state', 'partially-assigned')
                    ->orWhere('completion_state', 'assigned');
            })
            ->pending()
            ->orderBy('id','DESC')
            ->first();
    }

    public function getAcceptedLinks()
    {
        return $this->with(['user','getHelps.user','getHelps'=> function($query)
                        {
                            $query->where('give_get_helps.status', '=', 'accepted');
                        }
                    ])
                    ->where(function ($query) {
                        $query->where('completion_state', 'partially-assigned')
                            ->orWhere('completion_state', 'assigned');
                    })
                    ->orderBy('updated_at','DESC')
                    ->get();
    }

    public function getRejectedLinks($id=null)
    {
        $query = $this->with(['user','getHelps.user','getHelps'=> function($query)
                            {
                                $query->where('give_get_helps.status', '=', 'rejected');
                            }
                        ])
                        ->where(function ($query) {
                            $query->where('completion_state', 'partially-assigned')
                                ->orWhere('completion_state', 'assigned');
                        })
                        ->rejected()
                        ->orderBy('updated_at','DESC');
        if(isset($id))
        {
            $query->where('user_id',$id);
        }
        $data = $query->get();
        return $data;
    }

    public function getPendingLinks()
    {
        return $this->with(['user','getHelps.user','getHelps'=> function($query)
                    {
                        $query->where('give_get_helps.status', '=', 'pending');
                    }
                    ])
                    ->where(function ($query) {
                        $query->where('completion_state', 'partially-assigned')
                            ->orWhere('completion_state', 'assigned');
                    })
                    ->pending()
                    ->orderBy('updated_at','DESC')
                    ->get();
    }

    public function lastGiveHelp($id)
    {
        return $this->where('user_id',$id)
                    ->orderBy('id','DESC')
                    ->first();
    }
}
