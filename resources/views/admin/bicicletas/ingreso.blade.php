
@extends('admin.template.main')


@section('title','Ingresando bicicleta del dueño : '. $user->name)

@section('head')


@endsection

@section('content')
	{!! Form::open() !!}
	<p>Elija una bicicleta :</p>
	@foreach($bikes as $bike)
		<input type='radio' value='{{ $bike->id }}' name="bike" required="required"  checked="true" title="{{$bike->descripcion}}" >{{ $bike->descripcion }}</input>
		<br>
	@endforeach
	<div class="form-group" id='notasN'>
		{!! Form::label('nota', 'Nueva Nota para Bicicleta') !!}
		{!! Form::text('nota', null ,['class' => 'form-control', 'placeholder' => 'Ingrese alguna nota sobre la bicicleta, en caso que sea necesario']) !!}
	</div>

	<div class="form-group" id='fecha_activaN' >
		{!! Form::label('fecha_a', 'Nueva Fecha de ingreso a la Universidad de la bicicleta') !!}
		{!! Form::text('fecha_a', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
	</div>

	<div class="form-group" id='hora_activaN'  >
		{!! Form::label('hora_a', 'Nueva Hora de ingreso a la Universidad de la bicicleta') !!}
		{!! Form::text('hora_a',date("H:i:s",time()) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
	</div>

	<div class="form-group" id='encargado_activaN'>
		{!! Form::label('encargado_a', 'Nuevo Encargado del ingreso a la Universidad de la bicicleta') !!}
		{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
	</div>
	{!! Form::close() !!}

	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection
