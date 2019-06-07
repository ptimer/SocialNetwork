<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	protected $fillable = [
        'name', 'description', 'user_id',
    ];


    public function subscribers(){
    	return $this->belongsToMany('App\User');
    }
}
