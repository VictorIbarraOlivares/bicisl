<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Type;
use App\Carrera;

use Illuminate\Support\Facades\Auth; /*para poder usar el Auth:: ...*/

use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;

class FuncionarioController extends Controller
{
   public function create()
    {
        $types = Type::all();
        $carreras = Carrera::all();
        return view('funcionario.users.create')->with('types', $types)->with('carreras', $carreras);
    }

    public function home()
    {
        $dia= date("Y-m-d");
        $bikes = DB::table('bikes')->where("fecha_a","=",$dia)
                ->join('users','users.id','=','bikes.user_id')
                ->select('bikes.id','bikes.activa','bikes.descripcion','bikes.hora_a','bikes.fecha_a','hora_s','fecha_s','bikes.encargado_s','bikes.encargado_a','users.name as dueño','bikes.nota')
                ->orderby("hora_a","asc")->get();

        /*INICIO BORRAR VISITANTES*/
        /*
        $visitas = DB::table('users')->where("type_id","=","1")->where("created_at","<>",$dia) ->get();
        dd($visitas);
        foreach ($visitas as $visita){
            $visita->delete();
        }
        FUNCIONA, SOLO HAY QUE DESCOMENTAR
        */
        /*FIN BORRAR VISITANTES*/
        return view('funcionario.home')->with('bikes',$bikes);
    }

    public function store(UserRequest $request)
    {
        //dd($request-> all());
        $user = new User($request -> all());
        $user->password = bcrypt($request->password);
        //dd($user);
        $user->save();

        Flash::success('Se ha registrado '. $user->name .' de forma exitosa!');
        return redirect()->route('funcionario.users.index');
    }

    public function index()
    {
        $users = DB::table('users')->orderBy('created_at','desc')->get();
        $types = Type::all();
        $carreras = Carrera::all();

        return view('funcionario.users.index')->with('users',$users)->with('carreras',$carreras);
    }

    public function edit($id)
    {
        $user = User::find($id);
        //$user = User::where('type_id',"=",3)->get();

        if($user->type_id == 2 || $user->type_id == 3){
            Flash::warning('Funcionario no tienes permiso para realizar esta acción ! ');
            return redirect()->route('funcionario.users.index');
        }
        else{
            $name = User::find($user->name);
            $rut = User::find($user->rut);
            return view('funcionario.users.edit')->with('user', $user)->with('name',$name)->with('rut',$rut);
        }
        

    }


    public function show($id)
    {
        $user = User::find($id);
        $type = Type::find($user->type_id);
        $carrera = Carrera::find($user->carrera_id);

        return view('funcionario.users.detalle')->with('user',$user)->with('type',$type)->with('carrera', $carrera);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->rut= $request->rut;
        $user->save();

        //flash('El usuario '. $user->name . ' ha sido editado con exito!', 'warning');
        Flash::warning('El usuario '. $user->name . ' ha sido editado con exito!');
        return redirect()->route('funcionario.users.index');
    }
}
 