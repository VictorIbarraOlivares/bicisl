@php
use App\User;

$user = User::find($bike->user_id);
$encargadoLLegada = User::find($bike->encargado_a);

if($bike->encargado_s != 0)
{
    $encargadoSalida = User::find($bike->encargado_s);
}else
{
    $encargadoSalida = 0;
}

@endphp
@extends('admin.template.main')


@section('title','Detalles bicicleta de : '. $user->name)

@section('head')

@endsection

@section('content')
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('descripcion', 'Descripcion') !!}
					{!! Form::text('descripcion', $bike->descripcion ,['class' => 'form-control', 'readonly' => 'readonly' ,'required']) !!}
				</div>
			</div>
			<div class="col-md-4">
				@if($bike->nota != "")
					<div class="form-group">
						{!! Form::label('nota', 'Nota') !!}
						{!! Form::text('nota', $bike->nota ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				@endif
			</div>
		</div>
		<hr>

		<!--ACÁ DEBERIA IR EL DETALLE, TERMINAR CUANDO ESTE LISTO LO DEL CLIENTE -->
		<h5 class="form-section"><strong>Detalles último Ingreso a la Universidad<strong></h5>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					{!! Form::label('fecha_a', 'Fecha') !!}
					{!! Form::text('fecha_a', formato_y_m_d($bike->fecha_a) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" >
					{!! Form::label('hora_a', 'Hora') !!}
					{!! Form::text('hora_a', $bike->hora_a ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" >
					{!! Form::label('encargado_a', 'Encargado ') !!}
					{!! Form::text('encargado_activa', $encargadoLLegada->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			
		</div>
		<hr>
		@if($bike->fecha_s != "0000-00-00")
			<h5 class="form-section"><strong>Detalles última Salida de la Universidad<strong></h5>
			
			<div class="row">
				
				<div class="col-md-4">
					<div class="form-group">
						{!! Form::label('fecha_s', 'Fecha') !!}
						{!! Form::text('fecha_salida', formato_y_m_d($bike->fecha_s) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group"  >
						{!! Form::label('hora_s', 'Hora') !!}
						{!! Form::text('hora_salida', $bike->hora_s ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id='encargado_salida' style="display: show;">
						{!! Form::label('encargado_s', 'Encargado') !!}
						{!! Form::text('encargado_salida', $encargadoSalida->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
			</div>
		@endif
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection