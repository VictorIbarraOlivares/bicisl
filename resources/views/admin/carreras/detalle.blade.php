@extends('admin.template.main')

@section('title','Detalles de la carrera ' . $carrera->name)

@section('content')

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name',  $carrera->name ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('codigo_carrera', 'Código Carrera') !!}
			{!! Form::text('codigo_carrera', $carrera->codigo_carrera ,['class' => 'form-control','readonly'=>'readonly']) !!}
		</div>

		<a href="{{ url()->previous() }}" class="btn btn-primary" title="Volver"><span class="fa fa-btn fa-sign-in" aria-hidden="true" title="Volver">Volver</span></a>


	
@endsection