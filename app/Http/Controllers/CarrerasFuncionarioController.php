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
        $carreras = Carrera::orderBy('name','ASC')->paginate(3);

        return view('funcionario.carreras.index')->with('carreras',$carreras);
    }

    public function show($id)//pasar una lista de los usuarios que pertenecen a la carrera
    {
        $carrera = Carrera::find($id);
        //$users = DB::table('users')->where('carrera_id','=',$id)->orderby("type_id","desc")->get();
        $users = User::orderBy('type_id','asc')->where('carrera_id','=',$id)->paginate(4);
        $contador = DB::table('users')->where('carrera_id','=',$id)->count();
        //dd($contador);
        return view('funcionario.carreras.detalle')->with('carrera',$carrera)->with('users',$users)->with('contador', $contador);
    }

}