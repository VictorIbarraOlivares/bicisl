<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Type;
use App\Carrera;
use App\Bike;
use App\Image;

use Illuminate\Support\Facades\Auth; /*para poder usar el Auth:: ...*/



use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;//eliminar esto,todo, el request y todo 

use Illuminate\Support\Facades\Validator;//para validar

class BicicletaClienteController extends Controller
{

    public function edit($id)
    {
        $user = Auth::user();
        $bikes = Bike::all();
        foreach($bikes as $bike){
            if($bike->user_id == $user->id){
                return view('cliente.bicicletas.edit')->with('bike',$bike)->with('user' ,$user);
            }
        }
    }

    public function update(Request $request)
    {
         //dd($request->all());
        $datos = $request->all();
        $reglas = array(
            'detalle' => 'min:4|max:30|string',
            'image' => 'mimes:jpeg,png'
        );
        
        $v = Validator::make($datos, $reglas);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->all());
            //withInput($request->except('password')) devuelve todos los inputs, excepto el password
        }

        $user = Auth::user();
        $bikes = Bike::all();
        foreach($bikes as $bike){
            if($bike->user_id == $user->id){
                if($bike->activa == 1){
                    Flash::warning($user->name . ' no puedes editar la bicicleta mientras esté en el sistema!');
                    return redirect()->route('cliente.home');
                }
                else{
                    $bike->detalle = $request->detalle;
                    $bike->save();
                    Flash::warning($user->name . ' Tu bicicleta ha sido editada con exito !');
                    return redirect()->route('cliente.home');
                }
            }
        }
    }

}
