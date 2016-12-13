
@extends('admin.template.main')


@section('title','Crear bicicleta para '. $user->name)

@section('head')
<script type="text/javascript">

function datos(id){
	if( id == 0){
		$("#notas").hide();
		$('#fecha_activa').hide();
		$('#hora_activa').hide();
		$('#encargado_activa').hide();
	}if( id == 1){
		$("#notas").show();
		$('#fecha_activa').show();
		$('#hora_activa').show();
		$('#encargado_activa').show();
	}
}

</script>
@endsection

@section('content')
	{!! Form::open(['route' => 'admin.bicicletas.store', 'method' => 'POST' , 'name' => 'creando']) !!}

		<div class="form-group">
			{!! Form::label('descripcion', 'Descripcion simple de la Bicicleta') !!}
			{!! Form::text('descripcion', null ,['class' => 'form-control', 'placeholder' => 'Descripcion simple ,ejemplo : Color - Tipo de bicicleta' ,'required']) !!}
		</div>

		<div class="form-group">
			<p>Opcion :</p>
			<input name='activa' type='radio' value='1' checked="checked"  title="Significa que la bicicleta esta en la Universidad" >Bicicleta Activa</input>
		</div>

		<div class="form-group" id='notas' ">
			{!! Form::label('nota', 'Nota para Bicicleta') !!}
			{!! Form::text('nota', null ,['class' => 'form-control', 'placeholder' => 'Ingrese alguna nota sobre la bicicleta en caso que sea necesario']) !!}
		</div>

		<div class="form-group" id='fecha_activa' ">
			{!! Form::label('fecha_a', 'Fecha de ingreso a la Universidad de la bicicleta') !!}
			{!! Form::text('fecha_a', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>

		<div class="form-group" id='hora_activa' " >
			{!! Form::label('hora_a', 'Hora de ingreso a la Universidad de la bicicleta') !!}
			{!! Form::text('hora_a', date("H:i:s",time()) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>

		<div class="form-group" id='encargado_activa' ">
			{!! Form::label('encargado_a', 'Encargado del ingreso a la Universidad de la bicicleta') !!}
			{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
			{!! Form::text('encargado_a', $encargado->id ,['class' => 'form-control', 'style' => 'display:none']) !!}
		</div>

		<div class="form-group" style="display: none;">
		{!! Form::label('user_id', 'Le pertenece a ') !!}
			{!! Form::text('user_id', $user->id ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Listo', ['class' => 'btn btn-primary', 'onclick' => 'return confirm("¿Seguro quieres Crear la Bicicleta? \n Esto afectara al registro de bicicletas en la Universidad")' ]) !!}
		</div>

	{!! Form::close() !!}

	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Cancelar</a>
@endsection
