<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;//para validar

use App\Http\Requests;
use Mail;
use App\User;
use App\Type;
use App\Carrera;
use App\Bike;
use Illuminate\Support\Facades\Auth; /*para poder usar el Auth:: ...*/

use Laracasts\Flash\Flash;

class BicicletasAdminController extends Controller
{
    public function detallehoy()
    {
        $dia= date("Y-m-d");
        $bikes = DB::table('bikes')->where("fecha_a","=",$dia)
                ->join('users','users.id','=','bikes.user_id')
                ->select('bikes.id','bikes.activa','bikes.descripcion','bikes.hora_a','bikes.fecha_a','hora_s','fecha_s','bikes.encargado_s','bikes.encargado_a','users.name as dueño','bikes.nota')
                ->orderby("hora_a","asc")->get();

        return view('admin.bicicletas.hoy')->with('bikes', $bikes);
    }

    public function editar($id)
    {
        $bike = Bike::find($id);
        return view('admin.bicicletas.modaleditar')->with('bike',$bike);
    }

    public function retiro($id)
    {
        //dd("estas en el controlador retiro");
        $bike = Bike::find($id);
        return view('admin.bicicletas.modalretiro')->with('bike',$bike);    
    }

    public function nota($id)
    {
        $bike = Bike::find($id);
        return view('admin.bicicletas.modalnota')->with('bike',$bike);
    }

    public function mostrar($id)
    {
        $hoy = date("Y-m-d");
        $bike = Bike::find($id);
        $dueño = User::find($bike->user_id);
        $carrera = Carrera::find($dueño->carrera_id);
        $encargadoLLegada = User::find($bike->encargado_a);
        if($bike->encargado_s != 0){
            $encargadoSalida = User::find($bike->encargado_s);
        }else{
            $encargadoSalida = "";
        }
        return view('admin.bicicletas.modaldetalle')->with('bike',$bike)->with('dueño',$dueño)->with('encargadoLLegada',$encargadoLLegada)->with('encargadoSalida',$encargadoSalida)->with('carrera',$carrera)->with('hoy',$hoy);
    }
    
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
        $datos = $request->all();
        $reglas = array(
            'color'     => 'min:4|max:10|required|alpha',
            'tipo' => 'min:5|max:10|required|alpha',
            'nota' => 'min:4|max:30|string'
        );
        
        $v = Validator::make($datos, $reglas);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->all());
            //withInput($request->except('password')) devuelve todos los inputs, excepto el password
        }

        $color=ucfirst(strtolower($request->color));//se da formato al color
        $tipo=ucfirst(strtolower($request->tipo));//se da formato al tipo

    	$user = User::find($request->user_id);
    	$bike = new Bike();
        $diaActual = date("Y-m-d");

        $bike->descripcion= $color." - ".$tipo;
        $bike->nota = $request->nota;
        $bike->fecha_a = $diaActual;
        $bike->hora_a = $request->hora_a;
        $bike->encargado_a = $request->encargado_a;
        $bike->activa = 1;
        $bike->user_id = $user->id;
    	//dd($request->all(),$bike);

    	$bike->save();

    	Flash::success('Se ha registrado la bicicleta de '.$user->name. ' de forma exitosa');
    	return redirect()->route('admin.home');


    }

    public function index()
    {
        $bikes = DB::table('bikes')
                ->join('users','users.id','=','bikes.user_id')
                ->select('users.id as usuario','users.name as dueño','bikes.activa','bikes.descripcion','bikes.id')
                ->orderBy('bikes.created_at','desc')->get();
    	//dd($bikes);

    	return view('admin.bicicletas.index')->with('bikes', $bikes);
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
        $descripcion = explode("-", $bike->descripcion);
    	return view('admin.bicicletas.edit')->with('bike',$bike)->with('user' ,$user)->with('encargado',$encargado)->with('descripcion',$descripcion);
    }

    public function update(Request $request,$id)
    {
        //dd($request->all());
        $datos = $request->all();
        $reglas = array(
            'color' => 'min:4|max:10|required|alpha',
            'tipo' => 'min:5|max:10|required|alpha',
            'nota' => 'min:4|max:30|string'
        );
        
        $v = Validator::make($datos, $reglas);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->all());
            //withInput($request->except('password')) devuelve todos los inputs, excepto el password
        }
        /*
        $request->descripcion = preg_replace('/[0-9]+/', '', $request->descripcion);//elimina números
        $request->descripcion = preg_replace('([^ A-Za-z0-9_-ñÑ])', '', $request->descripcion);//elimina caracteres especiales
        */
        $request->nota = preg_replace('/[0-9]+/', '', $request->nota);//elimina números
        $request->nota = preg_replace('([^ A-Za-z0-9_-ñÑ])', '', $request->nota);//elimina caracteres especiales
        $request->notaNueva = preg_replace('/[0-9]+/', '', $request->notaNueva);//elimina números
        $request->notaNueva = preg_replace('([^ A-Za-z0-9_-ñÑ])', '', $request->notaNueva);//elimina caracteres especiales
        $color=ucfirst(strtolower($request->color));//se da formato al color
        $tipo=ucfirst(strtolower($request->tipo));//se da formato al tipo
        $descripcion= $color." - ".$tipo;

        $encargado = Auth::user();
        $bike = Bike::find($id);
        $user = User::find($bike->user_id);
        
        $aux = 0;//aux para mensaje de editar
        //solo si cambia el activa
        if ($request->activa != $bike->activa){
            if($request->activa == 0){
                $bike->encargado_s = $encargado->id;
                $bike->fecha_s = date("Y-m-d");
                $bike->activa = $request->activa;
                $bike->descripcion = $descripcion;
                $bike->nota = "";//se borra la nota, ya que esta pensada para la llegada de la bicicleta
                $bike->hora_s = date("H:i:s",time());
                
            }else{
                $bike->encargado_a = $encargado->id;
                $bike->fecha_a = date("Y-m-d");
                $bike->activa = $request->activa;
                $bike->descripcion = $descripcion;
                $bike->nota = $request->notaNueva;
                $bike->hora_a = date("H:i:s",time());

            }
        }else{
            //si se edita la nota
            if($bike->nota != $request->nota){
                $bike->nota = $request->nota;
                $aux++;
            }
            //si se edita la descripcion
            if($bike->descripcion != $descripcion){
                $bike->descripcion = $descripcion;
                $aux++;
            }
            if($aux == 0){
               Flash::warning('No se ha editado nada de la Bicicleta del dueño '. $user->name . ' !');
                return redirect()->route('admin.bicicletas.index'); 
            }
            
        }
        $bike->save();

        Flash::warning('La bicicleta del dueño '. $user->name . ' ha sido editada con exito !');
        return redirect()->route('admin.bicicletas.index');
    }

    public function eliminar($id)
    {
        $bike = Bike::find($id);
        return view('admin.bicicletas.modaleliminar')->with('bike',$bike);
    }

    public function destroy($id)
    {
        $bike = Bike::find($id);
        $user = User::find($bike->user_id);
        $bike->delete();

        Flash::error('La Bicicleta del usuario '. $user->name .' ha sido eliminada de forma exitosa !');
        return redirect()->route('admin.bicicletas.index');
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
            if($user->type_id != 1){
                /*
                Mail::send('mensaje',['user' => $user],function($msje) use ($user){
                    $msje->subject('SALIDA BICICLETA');             
                    $msje->to($user->email);
                });
                */
            }
            

        }else{
            $bike->encargado_a = $encargado->id;
            $bike->fecha_a = date("Y-m-d");
            $bike->activa = 1;
            $bike->hora_a = date("H:i:s",time());
            Flash::warning('Se ingreso la bicicleta de '. $user->name . ' !');
        }

        $bike->save();

        return redirect()->back();
        //return redirect()->route('admin.home');
    }

    public function ingreso(Request $request)
    {
        $dia= date("Y-m-d");//obtener con la hora
        $valor = $request->get('valor');
        //dd($valor);
        $encargado = Auth::user();
        $user = User::find($valor);
        //dd($user);
        if($user != null)
        {
            $bikes = DB::table('bikes')->where('user_id','=',$valor)//->where('activa','=','0')
                     ->get();
            if($bikes != null){
                foreach($bikes as $bike){
                    if($bike->activa == 1){
                        Flash::error('Ya hay bicicleta activa del dueño '.$user->name);
                        return redirect()->route('admin.home');
                    }
                }
                return view('admin.bicicletas.ingreso')->with('user',$user)->with('bikes',$bikes)->with('encargado',$encargado);
            }else{
                Flash::error('No hay bicicletas para ingresar del dueño '.$user->name);
                return redirect()->route('admin.home');
            }
        }else{
            Flash::error('Ingrese seleccionando un nombre de la lista sugerida porfavor');
            return redirect()->route('admin.home');
        }
    }

    public function ingresa(Request $request)
    {
        $bike = Bike::find($request->bike);
        //dd($bike,$request->all());
        if($bike->activa == 0)
        {
            $hoy=date("Y-m-d");
            $encargado = Auth::user();
            $bike->activa = 1;
            $bike->nota = $request->nota;
            $bike->hora_a = $request->hora_a;
            $bike->fecha_a = $hoy;
            $bike->encargado_a = $encargado->id;
            //dd($bike);
            $bike->save();
            Flash::success('Se ha ingresado correctamente la bicicleta , descripcion: '.$bike->descripcion);
            return redirect()->route('admin.home'); 

        }else{
            Flash::error('La bicicleta seleccionada , registra como presente en la Universidad');
            return redirect()->route('admin.home'); 
        }
    }

    public function note($id)
    {
        $bike = Bike::find($id);
        $html = "";
        $html .= "<p style='font-weight:bold;'>Nota de la bicicleta : " .$bike->nota. " </p>";
        echo $html;

    }



}
