<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $table= "bikes";
    

    protected $fillable = [
    	'user_id','detalle','nota','descripcion','activa','fecha_a','hora_a','fecha_s','hora_s','encargado_a','encargado_s'
    ];

    //una bicicleta puede tener un usuario
    public function dueño()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    //una bicicleta puede tener una imagen
    public function image()
    {
    	return $this->hasOne('App\Image');
    }
}
