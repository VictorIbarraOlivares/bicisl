
@extends('admin.template.main')


@section('title','Editar bicicleta de '. $user->name)

@section('head')
<script type="text/javascript">

function datos(id){
	if( id == 0){
		$("#notas").hide();
		$('#fecha_activa').hide();
		$('#hora_activa').hide();
		$('#encargado_activa').hide();
		$('#fecha_salida').show();
		$('#hora_salida').show();
		$('#encargado_salida').show();
	}if( id == 1){
		$("#notas").show();
		$('#fecha_activa').show();
		$('#hora_activa').show();
		$('#encargado_activa').show();
		$('#fecha_salida').hide();
		$('#hora_salida').hide();
		$('#encargado_salida').hide();
	}
}

</script>
@endsection

@section('content')
	{!! Form::open(['route' => ['admin.bicicletas.update',$bike ], 'method' => 'PUT' ]) !!}

		<div class="form-group">
			{!! Form::label('descripcion', 'Descripcion simple de la Bicicleta') !!}
			{!! Form::text('descripcion', $bike->descripcion ,['class' => 'form-control', 'placeholder' => 'Descripcion simple ejemplo : color y tipo' ,'required']) !!}
		</div>

		<div class="form-group">
			<p>Eliga una opcion :</p>
			@if($bike->activa == 1)<!-- ESTE IF ES PARA MOSTRAR INFO DEPENDIENDO SI ESTA ACTIVA O NO -->
				<input name='activa' type='radio' value='0'  onclick="datos(this.value)" title="Significa que la bicicleta NO esta en la Universidad" >Bicicleta no Activa</input>
				<br>
				<input name='activa' type='radio' value='1' checked="checked" onclick="datos(this.value)" title="Significa que la bicicleta esta en la Universidad" >Bicicleta Activa</input>
				<div class="form-group" id='notas' style="display: show;">
					{!! Form::label('nota', 'Nota para Bicicleta') !!}
					{!! Form::text('nota', $bike->nota ,['class' => 'form-control', 'placeholder' => 'Ingrese alguna nota sobre la bicicleta en caso que sea necesario']) !!}
				</div>

				<div class="form-group" id='fecha_activa' style="display: show;">
					{!! Form::label('fecha_a', 'Fecha de ingreso a la Universidad de la bicicleta') !!}
					{!! Form::text('fecha_a', $bike->fecha_a ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>

				<div class="form-group" id='hora_activa' style="display: show;" >
					{!! Form::label('hora_a', 'Hora de ingreso a la Universidad de la bicicleta') !!}
					{!! Form::text('hora_a', $bike->hora_a ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>

				<div class="form-group" id='encargado_activa' style="display: show;">
					{!! Form::label('encargado_a', 'Encargado del ingreso a la Universidad de la bicicleta') !!}
					{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			@else
				<input name='activa' type='radio' value='0' checked="checked" onclick="datos(this.value)" title="Significa que la bicicleta NO esta en la Universidad" >Bicicleta no Activa</input>
				<br>
				<input name='activa' type='radio' value='1'  onclick="datos(this.value)" title="Significa que la bicicleta esta en la Universidad" >Bicicleta Activa</input>

				<div class="form-group" id='fecha_salida' style="display: show;">
					{!! Form::label('fecha_s', 'Fecha de salida de la Universidad ,de la bicicleta') !!}
					{!! Form::text('fecha_salida', $bike->fecha_s ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>

				<div class="form-group" id='hora_salida' style="display: show;" >
					{!! Form::label('hora_s', 'Hora de salida de la Universidad ,de la bicicleta') !!}
					{!! Form::text('hora_salida', $bike->hora_s ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>

				<div class="form-group" id='encargado_salida' style="display: show;">
					{!! Form::label('encargado_s', 'Encargado del salida de la Universidad ,de la bicicleta') !!}
					{!! Form::text('encargado_salida', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			@endif
		</div>

		

		<div class="form-group" style="display: none;">
			{!! Form::label('user_id', 'Le pertenece a ') !!}
			{!! Form::text('user_id', $bike->user_id ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Listo', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Cancelar</a>
@endsection
