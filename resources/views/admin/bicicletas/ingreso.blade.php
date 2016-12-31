@extends('admin.template.main')


@section('title','Ingresando bicicleta del dueño : '. $user->name)

@section('head')


@endsection

@section('content')
	{!! Form::open(['route' => ['admin.bicicletas.ingresa' ] , 'method' => 'get']) !!}
	<p>Elija una bicicleta :</p>
	@foreach($bikes as $bike)
		<input type='radio' value='{{ $bike->id }}' name="bike" required="required"  checked="true" title="{{$bike->descripcion}}" >{{ $bike->descripcion }}</input>
		@if($bike->fecha_a == date("Y-m-d"))
			<br>
			<li style="font-weight:bold;list-style:none;"><span class="glyphicon glyphicon-eye-open " style="color: #FF0000" aria-hidden="true"></span>  Está bicicleta registra ingreso el día de hoy</li>
		@endif
		<br>
	@endforeach
	<div class="form-group" >
		{!! Form::label('nota', 'Nueva Nota para Bicicleta') !!}
		{!! Form::text('nota', '' ,['class' => 'form-control', 'placeholder' => 'Ingrese alguna nota sobre la bicicleta, en caso que sea necesario']) !!}
	</div>

	<div class="form-group" >
		{!! Form::label('fecha_a', 'Nueva Fecha de ingreso a la Universidad de la bicicleta') !!}
		{!! Form::text('fecha_a', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
	</div>

	<div class="form-group"  >
		{!! Form::label('hora_a', 'Nueva Hora de ingreso a la Universidad de la bicicleta') !!}
		{!! Form::text('hora_a',date("H:i:s",time()) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
	</div>

	<div class="form-group" >
		{!! Form::label('encargado_a', 'Nuevo Encargado del ingreso a la Universidad de la bicicleta') !!}
		{!! Form::text('encargado_a', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
	</div>

	<div class="form-group">
			{!! Form::submit('Ingresar', ['class' => 'btn btn-danger']) !!}
		</div>
	{!! Form::close() !!}

	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection
