<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class TestController extends Controller
{
    public function view($id)
    {
    	$funcionario = User::find($id);
    	$funcionario->type;
    	
    	return view('admin.Funcionarios.view',['funcionario' => $funcionario]);
    }
}
