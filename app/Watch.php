<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    protected $fillable =['user_id','discussion_id'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function reply()
    {
    	return $this->belongsTo('App\Reply');
    }
}
