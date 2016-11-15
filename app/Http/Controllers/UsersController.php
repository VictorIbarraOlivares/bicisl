<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Laracasts\Flash\Flash;

class UsersController extends Controller
{
    public function create()
    {
    	return view('admin.users.create');
    }

    public function store(Request $request)
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
        $users = User::orderBy('type_id','ASC')->paginate(1);

        return view('admin.users.index')->with('users',$users);
    }
}
