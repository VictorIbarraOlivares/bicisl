<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Type;
use App\Carrera;
use App\Bike;
use Illuminate\Support\Facades\Auth; /*para poder usar el Auth:: ...*/

use Laracasts\Flash\Flash;

class BicicletasFuncController extends Controller
{
    //el id es del usuario
    public function create($id)
    {
        /*
        $creador = Auth::user();
        if($creador->type_id == 2 ){
            return view('admin.bicicletas.create')->with('user',$user);
        }
        */
        $encargado = Auth::user();
        $user = User::find($id);

        if($user->type_id == 2 || $user->type_id == 3){
            Flash::warning('Funcionario no tienes permiso para realizar esta acción ! ');
            return redirect()->route('funcionario.users.index');
        }
        else{
            return view('funcionario.bicicletas.create')->with('user',$user)->with('encargado', $encargado);
        }
        
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $user = User::find($request->user_id);
        $bike = new Bike($request->all());
        //dd($bike);
        if($bike->fecha_a != ""){
            $bike->fecha_a = date("Y-m-d");
        }

        $bike->save();

        Flash::success('Se ha registrado la bicicleta de '.$user->name.' de forma exitosa');
        return redirect()->route('funcionario.bicicletas.index');


    }

    public function index()
    {
        $bikes = Bike::all();
        $users = User::all();
        //dd($bikes);

        return view('funcionario.bicicletas.index')->with('bikes', $bikes)->with('users', $users);
    }

    public function edit($id)
    {
        $bike = Bike::find($id);
        $user = User::find($bike->user_id);
        if($bike->activa == 1){
            $encargado = User::find($bike->encargado_a);
        }else
        {
            $encargado = "no hay encargado";
        }
        

        return view('funcionario.bicicletas.edit')->with('bike',$bike)->with('user' ,$user)->with('encargado',$encargado);
    }
}
