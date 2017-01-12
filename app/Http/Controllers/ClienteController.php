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
use App\Http\Requests\UserRequest;//eliminar esto,todo, el request y todo 

use Illuminate\Support\Facades\Validator;//para validar

use Rut;


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
        $perfil = Auth::user();
        $user = User::find($id);
        if($perfil->id == $user->id){
            $title = "Mi Perfil";
            $particiones = explode(" ",$user->name);
            if(count($particiones) == 2){
                $nombre = $particiones[0];
                $apellido = $particiones[1];
            }else{
                $nombre = $particiones[0];
                $apellido = "";
            }

            return view('cliente.users.edit')->with('user', $user)->with('title',$title)->with('nombre',$nombre)->with('apellido',$apellido);
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
            'nombre'     => 'min:4|max:15|required|alpha',
            'apellido' => 'min:3|max:15|required|alpha',
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
        $nombre=ucfirst(strtolower($request->nombre));//se da formato al nombre
        $apellido=ucfirst(strtolower($request->apellido));//se da formato al apellido
        
        //dd($request->all());
        $user = User::find($id);
        $user->name = $nombre." ".$apellido;
        $user->email= $request->email;
        $user->save();
        $encargado = Auth::user();
        Flash::warning('Tú perfil ha sido editado con exito '. $user->name . ' !');

        return redirect()->route('cliente.users.index');
    }
}