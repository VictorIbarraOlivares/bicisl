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
use Illuminate\Support\Facades\Auth; /*para poder usar el Auth:: ...*/

use Laracasts\Flash\Flash;

class BicicletasAdminController extends Controller
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

        if( $user->type_id == 2 || $user->type_id == 3){

            Flash::warning('No se puede agregar bicicleta a '. $user->name . ' !');
            return redirect()->route('admin.users.index');
        }

    	return view('admin.bicicletas.create')->with('user',$user)->with('encargado', $encargado);
    	
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
    	return redirect()->route('admin.bicicletas.index');


    }

    public function index()
    {
        $bikes = DB::table('bikes')->orderBy('created_at','desc')->get();
    	$users = User::all();
    	//dd($bikes);

    	return view('admin.bicicletas.index')->with('bikes', $bikes)->with('users', $users);
    }

    public function edit($id)
    {
    	$bike = Bike::find($id);
    	$user = User::find($bike->user_id);
    	if($bike->activa == 1){
    		$encargado = User::find($bike->encargado_a);
    	}else
    	{
    		$encargado = User::find($bike->encargado_s);
    	}


    	return view('admin.bicicletas.edit')->with('bike',$bike)->with('user' ,$user)->with('encargado',$encargado);
    }

    public function update(Request $request,$id)
    {
        //dd($request->all());
        $encargado = Auth::user();
        $bike = Bike::find($id);
        $user = User::find($bike->user_id);
        if ($request->activa != $bike->activa){
            if($request->activa == 0){
                $bike->encargado_s = $encargado->id;
                $bike->fecha_s = date("Y-m-d");
                $bike->activa = $request->activa;
                $bike->nota = "";//se borra la nota, ya que esta pensada para la llegada de la bicicleta
                $bike->hora_s = date("H:i:s",time());
            }else{
                $bike->encargado_a = $encargado->id;
                $bike->fecha_a = date("Y-m-d");
                $bike->activa = $request->activa;
                $bike->nota = $request->nota;
                $bike->hora_a = date("H:i:s",time());
            }
        }else{
            Flash::warning('No se ha editado nada de la Bicicleta del dueño '. $user->name . ' !');
            return redirect()->route('admin.bicicletas.index');
        }
        $bike->save();

        Flash::warning('La bicicleta del dueño '. $user->name . ' ha sido editada con exito !');
        return redirect()->route('admin.bicicletas.index');
    }

    public function destroy($id)
    {
        $bike = Bike::find($id);
        $user = User::find($bike->user_id);
        $bike->delete();

        Flash::error('La Bicicleta del usuario '. $user->name .' ha sido eliminada de forma exitosa !');
        return redirect()->route('admin.bicicletas.index');
    }

    public function ingreso(Request $request)
    {
        $dia= date("Y-m-d");//obtener con la hora
        $encargado = Auth::user();
        /*pueden haber personas con el mismo nombre, hacer filtro, como ?*/
        /* HACER TODA LA DINAMICA, VER SI ENCUENTRA CLIENTE Y AVANZAR ,SINO DEVOLVER*/
        $consulta = DB::table('users')->where('name','=', $request->get('q'))->where('type_id','=','4')->get();
        if($consulta != null){
            foreach ($consulta as $user) 
            {
                $bikes = DB::table('bikes')->where('user_id','=',$user->id)->where('activa','=','0')->where('fecha_a','<>',$dia)->get();
                if($bikes != null){
                    return view('admin.bicicletas.ingreso')->with('user',$user)->with('bikes',$bikes)->with('encargado',$encargado);
                }else{
                    Flash::error('No hay bicicletas para ingresar del dueño '.$user->name);
                    return redirect()->route('admin.home');
                }
                
            }
        }else{
            Flash::error('Ingrese un nombre de la lista sugerida porfavor');
            return redirect()->route('admin.home');
        }
        
        //dd($consulta);
        //$bikes = DB::table('bikes')->orderBy('created_at','desc')->get();
        
        //return view('admin.bicicletas.ingreso');
    }

    public function show($id)
    {

        $bike = Bike::find($id);
        /*
        $user = User::find($bike->user_id);
        $encargadoLLegada = User::find($bike->encargado_a);

        if($bike->encargado_s != 0)
        {
            $encargadoSalida = User::find($bike->encargado_s);
        }else
        {
            $encargadoSalida = 0;
        }
        */
        return view('admin.bicicletas.detalle')->with('bike',$bike);
    }

    public function cambiar($id)
    {
        $encargado = Auth::user();
        $bike = Bike::find($id);
        $user = User::find($bike->user_id);
        if($bike->activa == 1){
            $bike->encargado_s = $encargado->id;
            $bike->fecha_s = date("Y-m-d");
            $bike->activa = 0;
            $bike->hora_s = date("H:i:s",time());
            Flash::warning('Se retiro la bicicleta de '. $user->name . ' !');
        }else{
            $bike->encargado_a = $encargado->id;
            $bike->fecha_a = date("Y-m-d");
            $bike->activa = 1;
            $bike->hora_a = date("H:i:s",time());
            Flash::warning('Se ingreso la bicicleta de '. $user->name . ' !');
        }

        $bike->save();


        return redirect()->route('admin.home');
    }

    public function note($id)
    {
        $bike = Bike::find($id);
        $html = "";
        $html .= "<p style='font-weight:bold;'>Nota de la bicicleta : " .$bike->nota. " </p>";
        echo $html;

    }



}
