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

        return view('Cliente.index')->with('user',$user)->with('carrera',$carrera);
    }

    public function edit()
    {
        $user = Auth::user();
        $auxName= $user->name;
        $auxEmail = $user->email;
        $title = "usuario ". $user->name;

        return view('Cliente.edit')->with('user', $user)->with('auxName',$auxName)->with('auxEmail',$auxEmail)->with('title',$title);
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
        
        return redirect()->route('Cliente.index');
    }
}