<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','rut','claveBici','type_id','carrera_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //un usuario puede tener un tipo
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    //un usuario puede tener una carrera
    public function carrera()
    {
        return $this->belongsTo('App\Carrera');
    }

    //un usuario puede tener "muchas" bicicletas
    public function bikes()
    {
        return $this->hasMany('App\Bike');
    }
}
