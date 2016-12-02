<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Carrera;

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
    	$carrera = new Carrera($request -> all());
    	//dd($carrera);
    	$carrera->save();

    	Flash::success('Se ha registrado la carrera '. $carrera->name .' de forma exitosa!');
    	return redirect()->route('admin.carreras.index');
    }

    public function index()
    {
    	$carreras = Carrera::orderBy('name','ASC')->paginate(3);

    	return view('admin.carreras.index')->with('carreras',$carreras);
    }

    public function show($id)//pasar una lista de los usuarios que pertenecen a la carrera
    {
    	$carrera = Carrera::find($id);

    	return view('admin.carreras.detalle')->with('carrera',$carrera);
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
    	$carrera->name = $request->name;
    	$carrera->codigo_carrera = $request->codigo_carrera;
    	$carrera->save();

    	Flash::warning('La carrera  '. $carrera->name . ' ha sido editada con exito!');
    	return redirect()->route('admin.carreras.index');

    }

}
