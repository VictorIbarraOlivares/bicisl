<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Type;
use App\Carrera;

use Illuminate\Support\Facades\Auth; /*para poder usar el Auth:: ...*/



use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;//eliminar esto,todo, el request y todo 

use Illuminate\Support\Facades\Validator;//para validar

use Rut;


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

    public function agregar($id)
    {
        $user = User::find($id);
        return view('funcionario.users.modalagregar')->with('user',$user);
    }

    public function store(UserRequest $request)
    {
        $datos = $request->all();
        $mensajes = array(
         'cl_rut' => 'Ingrese rut valido porfavor',
         );
        /*SE MODIFICAN REGLAS SEGUN TIPO DE USUARIO*/
        $reglas = array(
            'nombre'     => 'min:4|max:15|required|alpha',
            'apellido' => 'min:3|max:15|required|alpha',
            'rut'      => 'between:7,12|unique:users|required|string|cl_rut',
            'tipo'  => 'required|in:Visita,Administrador,Funcionario,Alumno',//pueden ser esos 4 tipos
            'email'    => 'min:6|max:30|unique:users|required_if:tipo,Administrador,Funcionario,Alumno|email',//se requiere si no es visita
            'password' => 'min:4|max:30|required_if:tipo,Administrador,Funcionario',//se requiere si el tipo es admin o func
            'carrera' => 'required_if:tipo,Alumno'//se requiere si el tipo es cliente,alumno
        );

        $v = Validator::make($datos, $reglas,$mensajes);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->except('password'));
            //withInput($request->except('password')) devuelve todos los inputs, excepto el password
        }
        $nombre=ucfirst(strtolower(htmlentities($request->nombre, ENT_QUOTES,'UTF-8')));//se da formato al nombre
        $apellido=ucfirst(strtolower(htmlentities($request->apellido, ENT_QUOTES,'UTF-8')));//se da formato al apellido
        /*formato rut ,para guardar en la base de datos, se guarda sin puntos ni guion y se guarda K*/
        $rut="";
        $aux=$request->rut;
        for ($i=0; $i<strlen($aux); $i++) {
            if (is_numeric($aux[$i]))
            {
                $rut.=$aux[$i];
            }
            if($i == (strlen($aux)-1) && $aux[$i] == "k")
            {

                $rut.=$aux[$i];
            }
        }
        /*fin formato rut*/
        /*FILTRO PARA QUE NO SE DUPLIQUEN LOS RUT*/
        $contador= DB::table('users')->where('rut','=', $rut)->count();
        if($contador != 0){
            Flash::warning('El rut ingresado ya esta en la base de datos!');
            return redirect()->back()->withInput($request->except('password'));
        }
        /*FIN FILTRO PARA QUE NO SE DUPLIQUEN LOS RUT*/
        $user = new User();
        if($request->tipo == "Administrador" || $request->tipo == "Funcionario"){//si el tipo de usuario es administrador o funcionario
            $user->carrera_id = "16";
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            if($request->tipo == "Administrador"){
                $user->type_id = 2;
            }else{
                $user->type_id = 3;
            }
        }elseif($request->tipo == "Visita"){//visita
            $user->carrera_id="17";
            $user->type_id = 1;
            $user->email= $rut."_".$user->carrera_id."VISITA@soyvisita.cls";//el mail no puede ser nulo
            $user->rut = $rut;
            $user->name = $nombre." ".$apellido;
            $user->save();
            Flash::success('Se ha registrado '. $user->name .' de forma exitosa!');
            return redirect()->route('funcionario.bicicletas.create', $user->id);
        }elseif($request->tipo == "Alumno"){//Alumno
            $user->password = bcrypt($rut);
            $user->type_id = 4;
            $user->email = $request->email;
            $user->name = $nombre." ".$apellido;
            $user->rut = $rut;
            $user->carrera_id = $request->carrera;
            $user->save();
            Flash::success('Se ha registrado '. $user->name .' de forma exitosa!');
            return redirect()->route('funcionario.bicicletas.create', $user->id);
        }
        
        $user->rut = $rut;
        $user->name = $nombre." ".$apellido;
        $user->save();

        Flash::success('Se ha registrado '. $user->name .' de forma exitosa!');
        return redirect()->route('funcionario.users.index');
    }

    public function index()
    {
        $users = DB::table('users')
                ->join('types','types.id','=','users.type_id')
                ->join('carreras','carreras.id','=','users.carrera_id')
                ->select('users.id','users.name','users.rut','users.email','types.name as nomTipo','types.id as tipo','carreras.name as nomCarrera','carreras.id as carrera','carreras.codigo_carrera')
                ->orderBy('users.created_at','desc')
                ->get();

        return view('funcionario.users.index')->with('users',$users);
    }

    public function edit($id)
    {
        $encargado = Auth::user();
        $user = User::find($id);
        if($user->type_id == 1 || $user->type_id == 4){
            //$user = User::where('type_id',"=",3)->get();
            $title = "usuario ". $user->name;

            $particiones = explode(" ",$user->name);
            if(count($particiones) == 2){
                $nombre = $particiones[0];
                $apellido = $particiones[1];
            }else{
                $nombre = $particiones[0];
                $apellido = "";
            }
            
            //dd($user);

            return view('funcionario.users.edit')->with('user', $user)->with('title',$title)->with('nombre',$nombre)->with('apellido',$apellido);
        }
        if($encargado->id == $user->id){
            $title = "mi Perfil";
            $particiones = explode(" ",$user->name);
            if(count($particiones) == 2){
                $nombre = $particiones[0];
                $apellido = $particiones[1];
            }else{
                $nombre = $particiones[0];
                $apellido = "";
            }

            return view('funcionario.users.edit')->with('user', $user)->with('title',$title)->with('nombre',$nombre)->with('apellido',$apellido);
        }
        else{
            Flash::warning('No tienes permiso para realizar esta acción');
            return redirect()->route('funcionario.users.index');
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
        $datos = $request->all();
        $mensajes = array(
         'cl_rut' => 'Ingrese rut valido porfavor',
         );

        /*SE MODIFICAN REGLAS SEGUN TIPO DE USUARIO*/
        $reglas = array(
            'nombre'     => 'min:4|max:15|required|alpha',
            'apellido' => 'min:3|max:15|required|alpha',
            'rut'      => 'between:7,12|unique:users|required|string|cl_rut',
            'email'    => 'min:4|max:30|unique:users|required_if:tipo,Administrador,Funcionario,Alumno|email',//se requiere si no es visita
        );
        /*formato rut ,para guardar en la base de datos, se guarda sin puntos ni guion y se guarda k*/
        $rut="";
        $aux=$request->rut;
        for ($i=0; $i<strlen($aux); $i++) {
            if (is_numeric($aux[$i]))
            {
                $rut.=$aux[$i];
            }
            if($i == (strlen($aux)-1) && $aux[$i] == "k")
            {

                $rut.=$aux[$i];
            }
        }
        /*fin formato rut*/

        /*INICIO MODIFICACION REGLAS*/
        //si no se modifica ni rut ni email
        if($user->rut == $rut && $user->email == $request->email){
            $reglas['rut'] = 'between:7,12|required|string|cl_rut';
            $reglas['email'] = 'min:4|max:250|required_if:tipo,Administrador,Funcionario,Alumno|email';
        }
        //si no se modifica el rut
        if($user->rut == $rut){
            $reglas['rut'] = 'between:7,12|required|string|cl_rut';
        }
        //si no se modifica el mail
        if($user->email == $request->email){
            $reglas['email'] = 'min:4|max:250|required_if:tipo,Administrador,Funcionario,Alumno|email';
        }
        /*FIN MODIFICACION REGLAS*/

        $v = Validator::make($datos, $reglas,$mensajes);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->except('password'));
            //withInput($request->except('password')) devuelve todos los inputs, excepto el password
        }

        $nombre=ucfirst(strtolower(htmlentities($request->nombre, ENT_QUOTES,'UTF-8')));//se da formato al nombre
        $apellido=ucfirst(strtolower(htmlentities($request->apellido, ENT_QUOTES,'UTF-8')));//se da formato al apellido
        
        //dd($request->all());
        $user = User::find($id);
        $user->name = $nombre." ".$apellido;
        $user->email= $request->email;
        $user->rut = $rut;
        //dd($user,$request->all());
        /*FILTRO PARA QUE NO SE DUPLIQUEN LOS RUT*/
        $contador= DB::table('users')->where('rut','=', $user->rut)->where('id','<>',$user->id)->count();
        if($contador != 0){
            Flash::warning('El rut ingresado ya esta en la base de datos!');
            return redirect()->back()->withInput($request->except('password'));
        }
        /*FIN FILTRO PARA QUE NO SE DUPLIQUEN LOS RUT*/
        $user->save();
        $encargado = Auth::user();
        if($encargado->id == $user->id){
            Flash::warning('Tú perfil ha sido editado con exito '. $user->name . ' !');
        }else{
            Flash::warning('El usuario '. $user->name . ' ha sido editado con exito!');
        }

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

    public function password()
    {
        $user = Auth::user();
        //dd($user);
        return view('funcionario.users.password')->with('user',$user);
    }

    public function cambiopassword(Request $request,$id)
    {   
        if(Auth::user()->id != $id){
            Flash::error('NO PUEDE CAMBIAR EL PASSWORD DE OTRO USUSARIO');
            return redirect()->route('funcionario.home');
        }
        $datos = $request->all();
        $mensajes = array(
         'cl_rut' => 'Ingrese rut valido porfavor',
         );
        $reglas = array(
            'password' => 'min:4|max:120|required',
            'nuevoPassword' => 'min:4|max:120|required',
            'repitePassword' => 'min:4|max:120|required|same:nuevoPassword'
        );

        $v = Validator::make($datos, $reglas,$mensajes);

        if($v->fails()){
            return redirect()->back()->withErrors($v->errors())->withInput($request->except('password'));
            //withInput($request->except('password')) devuelve todos los inputs, excepto el password
        }else{
            if (Hash::check($request->password, Auth::user()->password)){
                $user = Auth::user();
                $user->password = Hash::make($request->nuevoPassword);
                $user->save();
                if($user->save()){
                    Flash::success('Nuevo password guardado correctamente');
                    return redirect()->route('funcionario.home');
                }else{
                    Flash::error('No se ha guardado el nuevo password');
                    return redirect()->route('funcionario.home');
                }
            }else{
                $user = Auth::user();
                Flash::error('El password actual no es correcto');
                return view('funcionario.users.password')->with('user',$user);
            }

        }
    }
}
 