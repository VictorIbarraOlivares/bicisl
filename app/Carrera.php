<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'carreras';

    protected $fillable = ['name','codigo_carrera'];

    //una carrera puede tener muchos usuarios
    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
