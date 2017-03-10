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
use App\Bike;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; /*para poder usar el Auth:: ...*/
use Mail;


use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;//eliminar esto,todo, el request y todo 

use Illuminate\Support\Facades\Validator;//para validar


class ClienteController extends Controller
{

    public function home()
    {
        $dia= date("Y-m-d");
        $user = Auth::user();
        $bikes = DB::table('bikes')->where("fecha_a","=",$dia)
                ->join('users','users.id','=','bikes.user_id')
                ->select('bikes.id','bikes.activa','bikes.user_id','bikes.descripcion','bikes.hora_a','bikes.fecha_a','hora_s','fecha_s','bikes.encargado_s','bikes.encargado_a','users.name as dueño','bikes.nota')
                ->orderby("hora_a","asc")->get();

    
        return view('cliente.home')->with('bikes', $bikes)->with('user', $user);
    }

    public function edit($id)
    {
        $perfil = Auth::user();
        $user = User::find($id);
        if($perfil->id == $user->id){
            $title = "Mi Perfil";

            return view('cliente.users.edit')->with('user', $user)->with('title',$title);
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
            }
            $bikes = DB::table('bikes')->where('user_id','=',$user->id)->get();
        }
        
        
        //dd($consulta);

       return view('cliente.users.detalle')->with('user',$user)->with('title',$title)->with('bikes',$bikes);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        
        $user = Auth::user();
        $datos = $request->all();

        /*SE MODIFICAN REGLAS SEGUN TIPO DE USUARIO*/
        $reglas = array(
            'email'    => 'min:4|max:250|unique:users|required_if:tipo,Administrador,Funcionario,Alumno|email',//se requiere si no es visita
        );
        /*formato rut ,para guardar en la base de datos, se guarda sin puntos ni guion y se guarda k*/
        
        //si no se modifica el mail
        if($user->email == $request->email){
            $reglas['email'] = 'min:4|max:250|required_if:tipo,Administrador,Funcionario,Alumno|email';
        }
        /*FIN MODIFICACION REGLAS*/

        $v = Validator::make($datos, $reglas);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->except('password'));
            //withInput($request->except('password')) devuelve todos los inputs, excepto el password
        }
        $user = User::find($id);
        $user->email= $request->email;
        $user->save();
        Flash::warning('Tú perfil ha sido editado con exito '. $user->name . ' !');

        return redirect()->route('cliente.home');
    }

    public function password()
    {
        $user = Auth::user();
        //dd($user);
        return view('cliente.users.password')->with('user',$user);
    }

    public function cambiopassword(Request $request,$id)
    {   
        if(Auth::user()->id != $id){
            Flash::error('NO PUEDE CAMBIAR EL PASSWORD DE OTRO USUARIO');
            return redirect()->route('cliente.home');
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
                    Mail::send('cambiocontrasena',['user' => $user],function($msje) use ($user){
                        $msje->subject('CAMBIO CONTRASENA');             
                        $msje->to($user->email);
                    });
                    Flash::success('Nuevo password guardado correctamente');
                    return redirect()->route('cliente.home');
                }else{
                    Flash::error('No se ha guardado el nuevo password');
                    return redirect()->route('cliente.home');
                }
            }else{
                $user = Auth::user();
                Flash::error('El password actual no es correcto');
                return view('cliente.users.password')->with('user',$user);
            }

        }
    }
    
}