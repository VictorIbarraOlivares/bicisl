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
        $encargado = Auth::user();
        if($encargado->id == $id){
            $name = $encargado->name;
            $rut = $encargado->rut;
            $correo = $encargado->email;
            return view('funcionario.users.edit')->with('user', $user)->with('name',$name)->with('rut',$rut);
        }
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
        
        $consulta = DB::table('users')->where('users.id','=',$id)
                ->join('types','types.id','=','users.type_id')
                ->join('carreras','carreras.id','=','users.carrera_id')
                ->select('users.id','users.name','users.rut','users.email','types.name as nomTipo','types.id as tipo','carreras.name as nomCarrera')
                ->get();//es un array de objetos
        $encargado = Auth::user();
        foreach($consulta as $au)
        {
            $user=$au;
            if($encargado->id == $user->id){
                $title = "Perfil";
            }else{
                $title = "de ". $user->name;
            }
            $bikes = DB::table('bikes')->where('user_id','=',$user->id)->get();
        }
        
        
        //dd($consulta);

       return view('funcionario.users.detalle')->with('user',$user)->with('title',$title)->with('bikes',$bikes);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $user = User::find($id);
        $user->name = $request->name;
        $user->rut= $request->rut;
        $user->email= $request->email;
        $user->save();

        //flash('El usuario '. $user->name . ' ha sido editado con exito!', 'warning');
        Flash::warning('El usuario '. $user->name . ' ha sido editado con exito!');
        return redirect()->route('funcionario.users.index');
    }

    public function autocomplete(Request $request)
    { 
        //previene que nose pueda ingresar por url
        if($request->ajax())
        {
            $term = $request->get('term');
            //dd($term);
            $results = array();

            $consultas = DB::table('users')->where('name','like', '%'.$term.'%')->where('type_id','=','4')->take(5)->get();

            foreach($consultas as $consulta)
            {
                $results[] = array ('id' => $consulta->id, 'value' => $consulta->name." Rut:".$consulta->rut);
            }

            return json_encode($results);
        }
    }
}
 