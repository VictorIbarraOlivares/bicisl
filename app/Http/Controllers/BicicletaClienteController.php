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
        $imageName = str_random(3) . '.' .
        Input::file('image')->getClientOriginalExtension();
        Request::file('image')->move(
        base_path() . '/public/images/', $imageName
        );
         //dd($request->all());
        

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
