<?php 
function formato_y_m_d($fecha){
	$particiones = explode("-", $fecha);
	$fecha = $particiones[2]."-".$particiones[1]."-".$particiones[0];
 	return $fecha;
}
?>
@extends('admin.template.main')


@section('title','Detalles bicicleta del dueño : '. $user->name)

@section('head')

@endsection

@section('content')
		<div class="form-group">
			{!! Form::label('descripcion', 'Descripcion simple de la Bicicleta') !!}
			{!! Form::text('descripcion', $bike->descripcion ,['class' => 'form-control', 'readonly' => 'readonly' ,'required']) !!}
		</div>
		@if($bike->nota != "")
		<div class="form-group">
			{!! Form::label('nota', 'Nota de la bicicleta') !!}
			{!! Form::text('nota', $bike->nota ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>
		@endif
		<div class="form-group">
			{!! Form::label('fecha_a', 'Fecha del último ingreso a la Universidad de la bicicleta') !!}
			{!! Form::text('fecha_a', formato_y_m_d($bike->fecha_a) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>
		<div class="form-group" >
			{!! Form::label('hora_a', 'Hora del último ingreso a la Universidad de la bicicleta') !!}
			{!! Form::text('hora_a', $bike->hora_a ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>
		<div class="form-group" >
			{!! Form::label('encargado_a', 'Encargado del último ingreso a la Universidad de la bicicleta') !!}
			{!! Form::text('encargado_activa', $encargadoLLegada->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>
		<hr>
		@if($bike->fecha_s != "0000-00-00")
		<div class="form-group">
				{!! Form::label('fecha_s', 'Fecha última salida de la Universidad de la bicicleta') !!}
				{!! Form::text('fecha_salida', formato_y_m_d($bike->fecha_s) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>
		<div class="form-group"  >
			{!! Form::label('hora_s', 'Hora última salida de la Universidad de la bicicleta') !!}
			{!! Form::text('hora_salida', $bike->hora_s ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>

		<div class="form-group" id='encargado_salida' style="display: show;">
			{!! Form::label('encargado_s', 'Encargado de la última salida de la Universidad de la bicicleta') !!}
			{!! Form::text('encargado_salida', $encargadoSalida->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>
		@endif
	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection