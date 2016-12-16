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
        //cambiar la solicitud para obtener todos los datos necesarios
        $bicis = DB::table('bikes')->where('activa','=',1)->orderby("id","desc")->get();
        return view('admin.home')->with('bicis', $bicis);
    }

    public function store(UserRequest $request)
    {
    	//dd($request-> all());
    	$user = new User($request -> all());
    	$user->password = bcrypt($request->password);
        if($user->type_id == 2 || $user->type_id == 3){//si el tipo de usuario es administrador o funcionario
            $user->carrera_id="16";
        }
    	//dd($user);
    	$user->save();

        Flash::success('Se ha registrado '. $user->name .' de forma exitosa!');
    	return redirect()->route('admin.users.index');
    }

    public function index()
    {
        $users = User::orderBy('created_at','desc')->paginate(3);
        $types = Type::all();
        $carreras = Carrera::all();

        return view('admin.users.index')->with('users',$users)->with('carreras' , $carreras);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Flash::error('El usuario '. $user->name . ' ha sido borrado de forma exitosa!');
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
        $user = User::find($id);
        $type = Type::find($user->type_id);
        $carrera = Carrera::find($user->carrera_id);
        $encargado = Auth::user();
        if($encargado->id == $id){
            $title = "Perfil";
        }else{
            $title = "de ".$user->name;
        }

        return view('admin.users.detalle')->with('user',$user)->with('type',$type)->with('carrera', $carrera)->with('title',$title);
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
        $user->save();

        //flash('El usuario '. $user->name . ' ha sido editado con exito!', 'warning');
        Flash::warning('El usuario '. $user->name . ' ha sido editado con exito!');
        return redirect()->route('admin.users.index');
    }
}
