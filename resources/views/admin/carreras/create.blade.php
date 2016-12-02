@extends('admin.template.main')

@section('title','Registrar Carrera')

@section('content')
	{!! Form::open(['route' => 'admin.carreras.store', 'method' => 'POST']) !!}

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name', null ,['class' => 'form-control', 'placeholder' => 'Ingrese nombre de la carrera' ,'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('codigo_carrera', 'Código Carrera') !!}
			{!! Form::number('codigo_carrera', null ,['class' => 'form-control', 'placeholder' => 'Ingrese código de la carrera' ,'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-success btn-lg']) !!}
		</div>

	{!! Form::close() !!}
@endsection