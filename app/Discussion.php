<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title','content','user_id','channel_id','slug'];

    public function channel()
    {
    	return $this->belongsTo('App\Channel');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function replies()
    {
    	return $this->hasMany('App\Reply');
    }

    public function watches()
    {
        return $this->hasMany('App\Watch');
    }

    public function is_watched_by_auth_user()
    {

        $id = Auth::id();

        $watchers = array();

        foreach ($this->watches as $watch) {
            
            array_push($watchers, $watch->user_id);
        }


        if (in_array($id, $watchers)) {

            return true;
            
        }
        else {

            return false;
        } 
        
    }

    public function hasBestAnswer()
    {
        $result = false;

        foreach ($this->replies as $reply) {
            
            if($reply->best_answer)
            {
                $result = true;

                break;
            }
            
        }

        return $result;
    }
}
