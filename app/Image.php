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
    public function sethPathAttribute($path){
    	$this->attributes['path'] = Carbon::now()->second.$path->getClientOriginalName();
    	$name = Carbon::now()->second.$path->getClientOriginalName();
    	\Storage::disk('local')->put($name, \File::get($path));
    }
}
