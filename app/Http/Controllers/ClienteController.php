<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Type;
use App\Image;

use Illuminate\Support\Facades\Auth; /*para poder usar el Auth:: ...*/

use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;


class ClienteController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $carrera = Carrera::find($user->carrera_id);

        return view('cliente.users.index')->with('user',$user)->with('carrera',$carrera);
    }

    public function edit($id)
    {
        $user = Auth::user();
        if($user->id == $id){
            $name = $user->name;
            $email = $user->email;
            return view('cliente.users.edit')->with('user', $user)->with('name',$name)->with('email',$email);
        }
    }


    public function show()
    { 
        
        
    }

    public function update(Request $request)
    {
        //dd($request->all());
        
        $user = Auth::user();
        $user->name = $request->name;
        $user->email= $request->email;
        $user->save();
        Flash::warning('Tú perfil ha sido editado con exito '. $user->name . ' !');
        
        return redirect()->route('cliente.index');
    }
}