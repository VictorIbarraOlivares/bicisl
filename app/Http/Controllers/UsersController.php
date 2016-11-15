<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

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
    	dd('Usuario Creado Satisfactoriamente');
    }

    public function index()
    {
        $users = User::orderBy('type_id','ASC')->paginate(1);

        return view('admin.users.index')->with('users',$users);
    }
}
