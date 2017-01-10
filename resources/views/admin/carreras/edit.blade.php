@extends('admin.template.main')

@section('title','Editar carrera ' . $carrera->name)

@section('content')
	{!! Form::open(['route' => ['admin.carreras.update',$carrera ] , 'method' => 'PUT']) !!}

		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					{!! Form::label('name', 'Nombre') !!}
					{!! Form::text('name',  $carrera->name ,['class' => 'form-control', 'placeholder' => 'Ingrese nombre' ,'required']) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('codigo_carrera', 'Código Carrera') !!}
					{!! Form::number('codigo_carrera', $carrera->codigo_carrera ,['class' => 'form-control', 'placeholder' => 'Ingrese código carrera' ,'required']) !!}
				</div>
			</div>
			
		</div>
		

		

		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
		</div>		

	{!! Form::close() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection