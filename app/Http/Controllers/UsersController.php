<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Type;

use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function create()
    {
        $types = Type::all();
    	return view('admin.users.create')->with('types', $types);
    }

    public function home()
    {
        return view('admin.home');
    }

    public function store(UserRequest $request)
    {
    	//dd($request-> all());
    	$user = new User($request -> all());
    	$user->password = bcrypt($request->password);
    	//dd($user);
    	$user->save();

        Flash::success('Se ha registrado '. $user->name .' de forma exitosa!');
    	return redirect()->route('admin.users.index');
    }

    public function index()
    {
        $users = User::orderBy('type_id','ASC')->paginate(3);
        $types = Type::all();

        return view('admin.users.index')->with('users',$users);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        Flash::error('El usario '. $user->name . ' ha sido borrado de forma exitosa!');
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
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
        return view('admin.users.edit')->with('user', $user)->with('types',$types)->with('auxId',$auxId)->with('auxName',$auxName);
    }

    public function show($id)
    {
        $user = User::find($id);
        $type = Type::find($user->type_id);

        return view('admin.users.detalle')->with('user',$user)->with('type',$type);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email= $request->email;
        $user->type_id = $request->type_id;
        $user->save();

        
        Flash::warning('El usuario '. $user->name . ' ha sido editado con exito!');
        return redirect()->route('admin.users.index');
    }
}
