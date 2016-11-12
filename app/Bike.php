<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    protected $table= "bikes";
    

    protected $fillable = [
    	'user_id','detalle',
    ];

    //una bicicleta puede tener un usuario
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
