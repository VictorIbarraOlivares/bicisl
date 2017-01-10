@php
	function formato_y_m_d($fecha)
	{
		$particiones = explode("-", $fecha);
		$fecha = $particiones[2]."-".$particiones[1]."-".$particiones[0];
	 	return $fecha;
	}
@endphp
@extends('admin.template.main')


@section('title','Editar bicicleta de : '. $user->name)

@section('head')
<script type="text/javascript">

function datos(id,valor){
	if( id != valor){
		if(id == 1){
			//se activan las opciones de nueva activa
			$("#titleI").show();
			$("#notasN").show();
			$('#fecha_activaN').show();
			$('#hora_activaN').show();
			$('#encargado_activaN').show();
			//se desactivan las opciones antiguas
			$('#titleSA').hide();
			$('#fecha_salida').hide();
			$('#hora_salida').hide();
			$('#encargado_salida').hide();
			$('#titleIA').hide();
			$("#notas").hide();
			$('#fecha_activa').hide();
			$('#hora_activa').hide();
			$('#encargado_activa').hide();
			//se desactivan las opciones nueva salida
			$('#titleS').hide();
			$('#fecha_salidaN').hide();
			$('#hora_salidaN').hide();
			$('#encargado_salidaN').hide();
		}
		if(id == 0){
			//se activan las opciones nueva salida
			$('#titleS').show();
			$('#fecha_salidaN').show();
			$('#hora_salidaN').show();
			$('#encargado_salidaN').show();
			//se desactivan las opciones antiguas
			$('#titleSA').hide();
			$('#fecha_salida').hide();
			$('#hora_salida').hide();
			$('#encargado_salida').hide();
			$('#titleIA').hide();
			$("#notas").hide();
			$('#fecha_activa').hide();
			$('#hora_activa').hide();
			$('#encargado_activa').hide();
			//se desactivan las opciones de nueva activa
			$("#titleI").hide();
			$("#notasN").hide();
			$('#fecha_activaN').hide();
			$('#hora_activaN').hide();
			$('#encargado_activaN').hide();
		}
	}if( id == valor){
		if(id == 1){
			$("#notas").show();
			$('#titleIA').show();
			$('#fecha_activa').show();
			$('#hora_activa').show();
			$('#encargado_activa').show();
			$('#titleSA').hide();
			$('#fecha_salida').hide();
			$('#hora_salida').hide();
			$('#encargado_salida').hide();
			//se desactivan las opciones nueva salida
			$('#titleS').hide();
			$('#fecha_salidaN').hide();
			$('#hora_salidaN').hide();
			$('#encargado_salidaN').hide();
			//se desactivan las opciones de nueva activa
			$("#titleI").hide();
			$("#notasN").hide();
			$('#fecha_activaN').hide();
			$('#hora_activaN').hide();
			$('#encargado_activaN').hide();
		}
		if(id == 0){
			$("#notas").hide();
			$('#titleIA').hide();
			$('#fecha_activa').hide();
			$('#hora_activa').hide();
			$('#encargado_activa').hide();
			$('#titleSA').show();
			$('#fecha_salida').show();
			$('#hora_salida').show();
			$('#encargado_salida').show();
			//se desactivan las opciones nueva salida
			$('#titleS').hide();
			$('#fecha_salidaN').hide();
			$('#hora_salidaN').hide();
			$('#encargado_salidaN').hide();
			//se desactivan las opciones de nueva activa
			$("#titleI").hide();
			$("#notasN").hide();
			$('#fecha_activaN').hide();
			$('#hora_activaN').hide();
			$('#encargado_activaN').hide();
		}
	}
}

</script>
@endsection

@section('content')
	{!! Form::open(['route' => ['admin.bicicletas.update',$bike ], 'method' => 'PUT' ]) !!}
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('descripcion', 'Descripcion') !!}
					{!! Form::text('descripcion', $bike->descripcion ,['class' => 'form-control', 'placeholder' => 'Descripcion simple ejemplo : color y tipo' ,'required']) !!}
				</div>
			</div>
			@if($bike->activa == 1)
			<div class="col-md-4">
				<div class="form-group" id='notas' style="display: show;">
					{!! Form::label('nota', 'Nota para Bicicleta') !!}
					{!! Form::text('nota', $bike->nota ,['class' => 'form-control', 'placeholder' => 'Ingrese alguna nota sobre la bicicleta en caso que sea necesario']) !!}
				</div>
			</div>
			@endif
		</div>
		

		
		<p><strong>Eliga una opcion :</strong> </p>
			
		
		<div class="form-group">
		@if($bike->activa == 1)<!-- ESTE IF ES PARA MOSTRAR INFO DEPENDIENDO SI ESTA ACTIVA O NO -->
			<div class="row">
				<div class="col-md-3">
					<input name='activa' type='radio' value='0'  onclick="datos(this.value,1)" title="Significa que la bicicleta NO esta en la Universidad" >Bicicleta no Activa</input>
				</div>
				<div class="col-md-3">
					<input name='activa' type='radio' value='1' checked="checked" onclick="datos(this.value,1)" title="Significa que la bicicleta esta en la Universidad" >Bicicleta Activa</input>
				</div>
			</div>
			<!--CODIGO PARA ACTIVA -->
			<hr>
			<h5 class="form-section" id="titleIA"><strong>Detalles último Ingreso a la Universidad<strong></h5>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group" id='fecha_activa' style="display: show;">
						{!! Form::label('fecha_a', 'Fecha ') !!}
						{!! Form::text('fecha_a', formato_y_m_d($bike->fecha_a) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id='hora_activa' style="display: show;" >
						{!! Form::label('hora_a', 'Hora') !!}
						{!! Form::text('hora_a', $bike->hora_a ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id='encargado_activa' style="display: show;">
						{!! Form::label('encargado_a', 'Encargado') !!}
						{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
			</div>
			<!--FIN CODIGO PARA ACTIVA -->
			@else
			<div class="row">
				<div class="col-md-3">
					<input name='activa' type='radio' value='0' checked="checked" onclick="datos(this.value,0)" title="Significa que la bicicleta NO esta en la Universidad" >Bicicleta no Activa</input>
				</div>
				<div class="col-md-3">
					<input name='activa' type='radio' value='1'  onclick="datos(this.value,0)" title="Significa que la bicicleta esta en la Universidad" >Bicicleta Activa</input>
				</div>
			</div>
			<hr>
			<h5 class="form-section" id="titleSA"><strong>Detalles última Salida de la Universidad<strong></h5>
				<!--CODIGO NO ACTIVA -->
			<div class="row">
				<div class="col-md-4">
					<div class="form-group" id='fecha_salida' style="display: show;">
						{!! Form::label('fecha_s', 'Fecha') !!}
						{!! Form::text('fecha_salida', formato_y_m_d($bike->fecha_s) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id='hora_salida' style="display: show;" >
						{!! Form::label('hora_s', 'Hora') !!}
						{!! Form::text('hora_salida', $bike->hora_s ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id='encargado_salida' style="display: show;">
						{!! Form::label('encargado_s', 'Encargado') !!}
						{!! Form::text('encargado_salida', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				
			</div>
			@endif
			<!--CODIGO CAMBIO DE ESTADO-->

			<!--CODIGO PARA ACTIVA -->
			<h5 class="form-section" id='titleI' style="display: none;"><strong>Detalles nuevo Ingreso a la Universidad<strong></h5>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group" id='notasN' style="display: none;">
						{!! Form::label('nota', 'Nueva Nota') !!}
						{!! Form::text('nota', null ,['class' => 'form-control', 'placeholder' => 'Ingrese nota en caso que sea necesario']) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group" id='fecha_activaN' style="display: none;">
						{!! Form::label('fecha_a', 'Nueva Fecha') !!}
						{!! Form::text('fecha_a', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id='hora_activaN' style="display: none;" >
						{!! Form::label('hora_a', 'Nueva Hora') !!}
						{!! Form::text('hora_a',date("H:i:s",time()) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id='encargado_activaN' style="display: none;">
						{!! Form::label('encargado_a', 'Nuevo Encargado') !!}
						{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
			</div>

			<!--CODIGO PARA NO ACTIVA -->
			<h5 class="form-section" id="titleS"><strong>Detalles nueva Salida de la Universidad<strong></h5>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group" id='fecha_salidaN' style="display: none;">
						{!! Form::label('fecha_s', 'Nueva Fecha') !!}
						{!! Form::text('fecha_salida', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id='hora_salidaN' style="display: none;" >
						{!! Form::label('hora_s', 'Nueva Hora') !!}
						{!! Form::text('hora_salida', date("H:i:s",time()),['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group" id='encargado_salidaN' style="display: none;">
						{!! Form::label('encargado_s', 'Nuevo Encargado') !!}
						{!! Form::text('encargado_salida', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					</div>
				</div>
				
			</div>
		</div>
		<!--FIN CODIGO CAMBIO DE ESTADO-->

		<div class="form-group">
			{!! Form::submit('Listo', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection
