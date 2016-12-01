<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images";

    protected $fillable = ['name','bike_id'];

    //una imagen puede tener una biciclceta
    public function bike()
    {
    	return $this->hasOne('App\Bike');
    }
}
