
@extends('funcionario.template.main')


@section('title','Ingresando bicicleta del dueño : '. $user->name)

@section('head')


@endsection

@section('content')
	{!! Form::open(['route' => ['funcionario.bicicletas.ingresa' ] , 'method' => 'get']) !!}
	<p><strong>Elija una bicicleta :</strong></p>
	<table class="table display" width="100%" cellpadding="0" cellspacing="0" id="bicicletas_ingreso">
		<thead>
			<th>Descripción</th>
			<th class="text-center">Ingresar</th>
			<th>Extra</th>
		</thead>
		<tbody>
			@foreach($bikes as $bike)
			<tr>
				<td>{{ $bike->descripcion }}</td>
				<td class="text-center">
					<input type='radio' value='{{ $bike->id }}' name="bike" required="required"  checked="true" ></input>
				</td>
				<td>
				@if($bike->fecha_a == date("Y-m-d"))
					<p style="font-weight:bold;"><span class="glyphicon glyphicon-eye-open " style="color: #FF0000" aria-hidden="true"></span>  Está bicicleta registra ingreso el día de hoy</p>
				@else

				@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<hr>
	<h5 class="form-section" style="color: #080266"><strong>Detalles nuevo Ingreso a la Universidad<strong></h5>
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				{!! Form::label('nota', 'Nueva Nota') !!}
				{!! Form::text('nota', null ,['class' => 'form-control', 'placeholder' => 'Ingrese nota en caso que sea necesario']) !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('fecha_a', 'Nueva Fecha') !!}
				{!! Form::text('fecha_a', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('hora_a', 'Nueva Hora') !!}
				{!! Form::text('hora_a',date("H:i:s",time()) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				{!! Form::label('encargado_a', 'Nuevo Encargado') !!}
				{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
			</div>
		</div>
	</div>

	<div class="form-group">
		{!! Form::submit('Ingresar', ['class' => 'btn btn-danger pull-left']) !!}
	</div>
	{!! Form::close() !!}

	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#bicicletas_ingreso').DataTable({
    	"bFilter": false,
    	"paging":   false,
        "ordering": false,
        "info":     false,
    });
});

</script>
@endsection