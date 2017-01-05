@php
	use App\User;
	function formato_y_m_d($fecha)
	{
	$particiones = explode("-", $fecha);
	$fecha = $particiones[2]."-".$particiones[1]."-".$particiones[0];
 	return $fecha;
	}
@endphp

@extends('funcionario.template.main')

@section('title','Detalles ' . $title)

@section('content')

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name',  $user->name ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('rut', 'Rut') !!}
			{!! Form::text('rut', $user->rut ,['class' => 'form-control','readonly'=>'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Correo Electronico') !!}
			{!! Form::text('email', $user->email ,['class' => 'form-control' ,'readonly'=>'readonly']) !!} <!-- No deberia ser requerido para los funcionarios -->
		</div>

		<div class="form-group">
			{!! Form::label('type_name','Tipo') !!}
			{!! Form::text('type_name',  $user->nomTipo ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>
		@if($user->tipo == 4)
			<div class="form-group">
				{!! Form::label('carera_id','Carrera') !!}
				{!! Form::text('carrera_name',  $user->nomCarrera ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
			</div>
		@endif
		<hr>
		<br>
		@if($bikes == null)
			<li style="font-weight:bold;list-style:none;"><span class="glyphicon glyphicon-eye-open " style="color: #FF0000" aria-hidden="true"></span> Este usuario no tiene registradas bicicletas</li>
			<br>
		@else
			<li style="font-weight:bold;list-style:none;"><span class="glyphicon glyphicon-eye-open " style="color: #FF0000" aria-hidden="true"></span> Bicicletas :</li>
			<br>
			<table class="table" width="100%" cellpadding="0" cellspacing="0" id="datatable_bicicletas">
			<thead>
				<th>¿Está en la Universidad ?</th>
				<th>Descripcion</th>
				<th>Fecha última llegada</th>
				<th>Encargado última llegada</th>
				<th>Fecha última salida</th>
				<th>Encargado última salida</th>
			</thead>
			<tbody>
				@foreach($bikes as $bike)
					@php
						$auxLlegada = 0;
						$auxSalida = 0;
						if($bike->encargado_a !=0){
							$encargadoLLegada = User::find($bike->encargado_a);
						}else{
							$auxLlegada = 1;
						}
						if($bike->encargado_s !=0){
							$encargadoSalida = User::find($bike->encargado_s);
						}else{
							$auxSalida = 1;
						}
						
					@endphp
					<tr>
						<th>
							@if($bike->activa == 1)
								Si
							@else
								No
							@endif
						</th>
						<th>{{ $bike->descripcion }}</th>
						<th>{{ formato_y_m_d($bike->fecha_a) }}</th>
						<th>
							@if($auxLlegada == 1)
								No hay datos
							@else
								{{ $encargadoLLegada->name }}
							@endif
						</th>
						<th>{{ formato_y_m_d($bike->fecha_s) }}</th>
						<th>
							@if($auxSalida == 1)
								No hay datos
							@else
								{{ $encargadoSalida->name }}
							@endif
						</th>
					</tr>
				@endforeach
			</tbody>
		</table>
		@endif


		<a href="{{ url()->previous() }}" class="btn btn-primary" title="Volver"><span class="fa fa-btn fa-sign-in" aria-hidden="true" title="Volver">Volver</span></a>

@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#datatable_bicicletas').DataTable({
    	dom: 'Bfrtip',
    	stateSave: true,
        buttons: [
            {
            	text: 'Ocular Columnas',
                extend: 'colvis',
                columns: ':not(:first-child)'
            }
        ]
    });
});

</script>
@endsection