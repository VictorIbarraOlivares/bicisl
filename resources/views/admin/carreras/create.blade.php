@extends('admin.template.main')

@section('title','Registrar Carrera')

@section('content')
	{!! Form::open(['route' => 'admin.carreras.store', 'method' => 'POST']) !!}

		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					{!! Form::label('name', 'Nombre') !!}
					{!! Form::text('name', null ,['class' => 'form-control', 'placeholder' => 'Ingrese nombre de la carrera' ,'required']) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('codigo_carrera', 'Código Carrera') !!}
					{!! Form::number('codigo_carrera', null ,['class' => 'form-control', 'placeholder' => 'Ingrese código de la carrera' ,'required']) !!}
				</div>
			</div>
		</div>		
		<hr>
		<div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-success pull-left']) !!}
		</div>
		<a href="{{ url()->previous() }}" class=" pull-right btn btn-danger" title="Volver">Volver</a>

	{!! Form::close() !!}
@endsection