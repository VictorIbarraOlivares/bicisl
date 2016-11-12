<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

	protected $table= "types";
    

    protected $fillable = [
    	'name'
    ];

    //un tipo de usuarios puede tener muchos usuarios
    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
