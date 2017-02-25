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
use Form;
use Html;
use File;
use Illuminate\Support\Facades\Input;

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
        $images = Image::all();
        foreach($bikes as $bike){
            if($bike->user_id == $user->id){
                foreach($images as $image){
                    if($image->bike_id == $bike->id)
                        return view('cliente.bicicletas.edit')->with('bike',$bike)->with('user' ,$user)->with('image' ,$image);
                }
            }
        }
    }

    public function update(Request $request)
    {
         //dd($request->all());
        $datos = $request->all();
        $reglas = array(
            'detalle' => 'min:4|max:30|string',
            'image' => 'mimes:jpeg,png,jpg'
        );
          
        
        $v = Validator::make($datos, $reglas);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->all());
            //withInput($request->except('password')) devuelve todos los inputs, excepto el password
        }
        $tipos = array('jpg','jpeg','PNG');
        $user = Auth::user();
        $bikes = Bike::all();
        $images = Image::all();
        foreach($bikes as $bike){
            if($bike->user_id == $user->id){
                if($bike->activa == 1){
                    Flash::warning($user->name . ' no puedes editar la bicicleta mientras esté en el sistema!');
                    return redirect()->route('cliente.home');
                }
                else{
                    foreach($images as $image){
                        if($image->bike_id == $bike->id){
                            $bike->detalle = $request->detalle;
                            $bike->save();
                            $extension = Input::file("image")->getClientOriginalExtension();
                            $extension = 'jpg';
                            if ($request->hasFile('image')) {
                                $tipoFile = explode('.',$image->name);
                                $auxid = explode('/', $tipoFile[0]);
                                if((int)$auxid[3] == $image->id){
                                    File::delete('/Bicicletas/'.$user->name.'/'.$image->id.'.'.$extension);
                                }
                                $destinationPath = 'Bicicletas/'.$user->name; // upload path
                                $fileName = $image->id.'.'.$extension; // renameing image    
                                Input::file('image')->move($destinationPath, $fileName); // uploading file to given 
                                $image->name = '/Bicicletas/'.$user->name.'/'.$fileName;
                                $image->save();
                                Flash::warning($user->name . ' Tu bicicleta ha sido editada con exito !');
                                return redirect()->route('cliente.home');
                            }
                        }
                    }
                }
            }
        }
    }

}
