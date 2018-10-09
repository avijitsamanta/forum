<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['user_id','discussions_id','content'];

    public function discussion()
    {
    	return $this->belongsTo('App\Discussion');
    }
}
