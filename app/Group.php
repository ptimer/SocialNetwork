<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function subscribers(){
    	return $this->belongsToMany('App\User');
    }
}
