@php
	foreach($consulta as $au)
        {
            $user=$au;
            if($encargado->id == $user->id){
                $title = "Perfil";
            }else{
                $title = "de ". $user->name;
            }
        }
@endphp

@extends('admin.template.main')

@section('title','Detalles ' . $title)

@section('content')

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name',  $user->name ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('rut', 'Rut') !!}
			{!! Form::text('rut', $user->rut ,['class' => 'form-control','readonly'=>'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Correo Electronico') !!}
			{!! Form::text('email', $user->email ,['class' => 'form-control' ,'readonly'=>'readonly']) !!} <!-- No deberia ser requerido para los funcionarios -->
		</div>

		<div class="form-group">
			{!! Form::label('type_name','Tipo') !!}
			{!! Form::text('type_name',  $user->nomTipo ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>
		@if($user->tipo == 3 || $user->tipo == 2)

		@else
			<div class="form-group">
			{!! Form::label('carera_id','Carrera') !!}
			{!! Form::text('carrera_name',  $user->nomCarrera ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>

		@endif


		<a href="{{ url()->previous() }}" class="btn btn-primary" title="Volver"><span class="fa fa-btn fa-sign-in" aria-hidden="true" title="Volver">Volver</span></a>

@endsection