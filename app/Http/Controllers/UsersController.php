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


class UsersController extends Controller
{
    public function create()
    {
        $types = Type::all();
        $carreras = Carrera::all();
    	return view('admin.users.create')->with('types', $types)->with('carreras', $carreras);
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
        return view('admin.home')->with('bikes', $bikes);
    }

    public function store(UserRequest $request)
    {
    	//dd($request-> all());
    	$user = new User($request -> all());
        if($user->type_id == 2 || $user->type_id == 3){//si el tipo de usuario es administrador o funcionario
            $user->carrera_id="16";
            $user->password = bcrypt($request->password);
        }elseif($user->type_id == 1){//visita
            $user->carrera_id="17";
            $user->email= $user->rut."_".$user->carrera_id."VISITA@soyvisita.cls";
        }elseif($user->type_id == 4){//"cliente"
            $user->password = bcrypt($request->rut);
            $user->save();
            Flash::success('Se ha registrado '. $user->name .' de forma exitosa!');
            
            $mensaje=['recibido'];
            $user = User::find($id);
            Mail::send('funcionario.home',$mensaje,function($msje){
                $msje->subject('SALIDA BICICLETA');                
                $msje->to($user->email);
            });
            return redirect()->route('admin.bicicletas.create', $user->id);
        }
    	//dd($user);
    	$user->save();

        Flash::success('Se ha registrado '. $user->name .' de forma exitosa!');
    	return redirect()->route('admin.users.index');
    }

    public function index()
    {
        $users = DB::table('users')->orderBy('created_at','desc')->get();
        $types = Type::all();
        $carreras = Carrera::all();

        return view('admin.users.index')->with('users',$users)->with('carreras' , $carreras);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Flash::error('El usuario '. $user->name . ' ha sido eliminado de forma exitosa!');
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $encargado = Auth::user();
        $user = User::find($id);
        //$user = User::where('type_id',"=",3)->get();
        $types = Type::all();
        foreach ($types as $type) 
        {
            if ($type->id == $user->type_id)
            {
                $auxId=$type->id;
                $auxName=$type->name;
            }
        }
        $carreras = Carrera::all();
        foreach ($carreras as $carrera) 
        {
            if($carrera->id == $user->carrera_id)
            {
                $auxIdCarrera = $carrera->id;
                $auxNameCarrera = $carrera->name;
            }
        }

        if($encargado->id == $id){
            $title = "mi Perfil";
        }else{
            $title = "usuario ". $user->name;
        }

        return view('admin.users.edit')->with('user', $user)->with('types',$types)->with('auxId',$auxId)->with('auxName',$auxName)->with('carreras',$carreras)->with('auxNameCarrera',$auxNameCarrera)->with('auxIdCarrera',$auxIdCarrera)->with('title',$title);
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

       return view('admin.users.detalle')->with('user',$user)->with('title',$title)->with('bikes',$bikes);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email= $request->email;
        $user->type_id = $request->type_id;
        $user->carrera_id = $request->carrera_id;
        if($user->type_id == 2 || $user->type_id == 3){//si el tipo de usuario es administrador o funcionario
            $user->carrera_id="16";
        }
        //dd($user);
        $user->save();
        $encargado = Auth::user();
        if($encargado->id == $user->id){
            Flash::warning('Tú perfil ha sido editado con exito '. $user->name . ' !');
        }else{
            Flash::warning('El usuario '. $user->name . ' ha sido editado con exito!');
        }

        //flash('El usuario '. $user->name . ' ha sido editado con exito!', 'warning');
        
        return redirect()->route('admin.users.index');
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
