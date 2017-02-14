<?php

namespace App\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Carrera;
use App\User;

use App\Http\Requests;

use Laracasts\Flash\Flash;

class CarrerasFuncionarioController extends Controller
{


    public function index()
    {

        $carreras = DB::table('carreras')->orderBy('created_at','desc')->get();
        return view('funcionario.carreras.index')->with('carreras',$carreras);
    }

    public function show($id)//pasar una lista de los usuarios que pertenecen a la carrera
    {
        $carrera = Carrera::find($id);
        //$users = DB::table('users')->where('carrera_id','=',$id)->orderby("type_id","desc")->get();
        $users = DB::table('users')->where('carrera_id','=',$id)
                ->join('types','types.id','=','users.type_id')
                ->select('users.id','users.name','users.rut','users.email','types.name as nomTipo','types.id as tipo')
                ->orderBy('users.type_id','asc')
                ->get();
        $contador = DB::table('users')->where('carrera_id','=',$id)->count();
        //dd($contador);
        return view('funcionario.carreras.detalle')->with('carrera',$carrera)->with('users',$users)->with('contador', $contador);
    }

}