<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    public function tasks(){
    	return $this->hasMany('App\Task');
    }
}
