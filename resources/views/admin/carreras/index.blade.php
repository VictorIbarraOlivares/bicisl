@extends('admin.template.main')

@section('title','Lista de Carreras')
@section('content')
<a href="{{ route('admin.carreras.create') }}" class="btn btn-info">Registrar nueva Carrera</a><br><br><br>
	<table class="table" width="100%" cellpadding="0" cellspacing="0" id="datatable_carreras">
		<thead>
			<th>Nombre</th>
			<th>Total Integrantes</th>
			<th>Código</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($carreras as $carrera)
				<tr>
					<td>{{ $carrera->name }}</td>
					<?php $contador = DB::table('users')->where('carrera_id','=',$carrera->id)->count(); ?>
					<td align="center"> {{ $contador }} </td>
					<td align="center">{{ $carrera->codigo_carrera }}</td>
					<td>
						 <a href="{{ route('admin.carreras.edit', $carrera->id ) }}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar"></span></a>
								<a href="{{ route('admin.carreras.destroy' , $carrera->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo? \n Esto probacará que se borren todos los clientes que pertenecen a esta carrera')" class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" title="Eliminar"></span>
								</a>
						<a href="{{ route('admin.carreras.detalle', $carrera->id ) }}" class="btn btn-success" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles"></span></a>

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#datatable_carreras').DataTable({
    	
    });
});

</script>
@endsection