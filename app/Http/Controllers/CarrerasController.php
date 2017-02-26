<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;//para validar

use App\Carrera;
use App\User;

use App\Http\Requests;

use Laracasts\Flash\Flash;


class CarrerasController extends Controller
{

    public function create()
    {
    	return view('admin.carreras.create');
    }

    public function store(Request $request)
    {
    	//dd($request-> all());
        $datos = $request->all();
        $mensajes = array(
         'codigo_carrera' => 'Código Carrera',
         );
        $reglas = array(
            'nombre'     => 'min:8|max:35|unique:carreras|required|string',
            'codigo_carrera' => 'digits_between:4,7|unique:carreras|required|numeric'
        );
        
        $v = Validator::make($datos, $reglas,$mensajes);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput($request->all());
            //withInput($request->except('password')) devuelve todos los inputs, excepto el password
        }
    	$carrera = new Carrera();
        $carrera->codigo_carrera = $request->codigo_carrera;
        $request->nombre = preg_replace('/[0-9]+/', '', $request->nombre );//elimina números
        $request->nombre = preg_replace('([^ A-Za-z0-9_-ñÑ])', '', $request->nombre );//elimina caracteres especiales
        $carrera->name = $request->nombre;
    	//dd($carrera);
    	$carrera->save();

    	Flash::success('Se ha registrado la carrera '. $carrera->name .' de forma exitosa!');
    	return redirect()->route('admin.carreras.index');
    }

    public function index()
    {

        $carreras = DB::table('carreras')->orderBy('created_at','desc')->get();
    	return view('admin.carreras.index')->with('carreras',$carreras);
    }

    public function show($id)//pasar una lista de los usuarios que pertenecen a la carrera
    {
    	$carrera = Carrera::find($id);
    	//$users = DB::table('users')->where('carrera_id','=',$id)->orderby("type_id","desc")->get();
    	//$users = User::orderBy('type_id','asc')->where('carrera_id','=',$id)->get();
        $users = DB::table('users')->where('carrera_id','=',$id)
                ->join('types','types.id','=','users.type_id')
                ->select('users.id','users.name','users.rut','users.email','types.name as nomTipo','types.id as tipo')
                ->orderBy('users.type_id','asc')
                ->get();
    	$contador = DB::table('users')->where('carrera_id','=',$id)->count();
    	//dd($contador);
    	return view('admin.carreras.detalle')->with('carrera',$carrera)->with('users',$users)->with('contador', $contador);
    }

    public function edit($id)
    {
    	$carrera = Carrera::find($id);

    	return view('admin.carreras.edit')->with('carrera', $carrera);
    }

    public function update(Request $request, $id)
    {
    	//dd($request->all());
        $carrera = Carrera::find($id);
        //solo si se cambia algo se ingresa
        if($carrera->name != $request->nombre || $carrera->codigo_carrera != $request->codigo_carrera){
            $datos = $request->all();
            $reglas = array(
                'nombre'     => 'min:8|max:35|unique:carreras|required|string',
                'codigo_carrera' => 'digits_between:4,7|unique:carreras|required|numeric'
            );
            
            if($carrera->name == $request->nombre){
                $reglas['name'] = 'min:8|max:35|required|string';
            }
            if($carrera->codigo_carrera == $request->codigo_carrera){
                $reglas['codigo_carrera'] = 'digits_between:4,7|required|numeric';
            }

            $v = Validator::make($datos, $reglas);

            if($v->fails())
            {
                return redirect()->back()->withErrors($v->errors())->withInput($request->all());
                //withInput($request->except('password')) devuelve todos los inputs, excepto el password
            }

            $carrera = Carrera::find($id);
            $carrera->name = $request->nombre;
            $carrera->name = preg_replace('/[0-9]+/', '', $carrera->name);//elimina números
            $carrera->name = preg_replace('([^ A-Za-z0-9_-ñÑ])', '', $carrera->name);//elimina caracteres especiales
            $carrera->codigo_carrera = $request->codigo_carrera;
            $carrera->save();

            Flash::warning('La carrera  '. $carrera->name . ' ha sido editada con exito!');
            return redirect()->route('admin.carreras.index');
        }
        

    }

    public function eliminar($id)
    {
        $carrera = Carrera::find($id);
        return view('admin.carreras.modaleliminar')->with('carrera',$carrera);
    }
    public function destroy($id)
    {
    	$carrera = Carrera::find($id);
    	$carrera->delete();

    	Flash::error('La carrera '.$carrera->name.' ha sido eliminada con exito!');
    	return redirect()->route('admin.carreras.index');
    }

}
