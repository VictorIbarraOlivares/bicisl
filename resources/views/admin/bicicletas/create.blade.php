
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
		<h5 class="form-section"><strong>Descripcion para Bicicleta<strong></h5>
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('color', 'Color') !!}
					{!! Form::text('color', null ,['class' => 'form-control', 'placeholder' => 'Ingrese Color' ,'required']) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('tipo','Tipo') !!}
					{!! Form::text('tipo',null,['class' => 'form-control','placeholder' => 'ej:montaña','required']) !!}
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group" id='notas' ">
					{!! Form::label('nota', 'Nota para Bicicleta') !!}
					{!! Form::text('nota', null ,['class' => 'form-control', 'placeholder' => 'Nota para bicicleta en caso que sea necesario']) !!}
				</div>
			</div>
			
		</div>
		<br>
		<hr>
		<div class="form-group">
			<p><strong>Opcion : </strong></p>
			<input name='activa' type='radio' value='1' checked="checked"  title="Significa que la bicicleta esta en la Universidad" >Bicicleta Activa</input>
		</div>

		<h5 class="form-section"><strong>Detalles Ingreso a la Universidad<strong></h5>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group" id='fecha_activa' ">
					{!! Form::label('fecha_a', 'Fecha') !!}
					{!! Form::text('fecha_a', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='hora_activa' " >
					{!! Form::label('hora_a', 'Hora') !!}
					{!! Form::text('hora_a', date("H:i:s",time()) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='encargado_activa' ">
					{!! Form::label('encargado_a', 'Encargado del ingreso') !!}
					{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					{!! Form::text('encargado_a', $encargado->id ,['class' => 'form-control', 'style' => 'display:none']) !!}
				</div>
			</div>
			
		</div>
		

		

		

		<div class="form-group" style="display: none;">
		{!! Form::label('user_id', 'Le pertenece a ') !!}
			{!! Form::text('user_id', $user->id ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Listo', ['class' => 'btn btn-success' ]) !!}
		</div>

	{!! Form::close() !!}

	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-danger" title="Volver">Cancelar</a>
@endsection
