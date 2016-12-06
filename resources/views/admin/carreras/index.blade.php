@extends('admin.template.main')

@section('title','Lista de Carreras')
@section('content')
<a href="{{ route('admin.carreras.create') }}" class="btn btn-info">Registrar nueva Carrera</a><br><br><br>
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Total</th>
			<th>Nombre</th>
			<th>Código</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($carreras as $carrera)
				<tr>
					<td>{{ $carrera->id }}</td>
					<?php $contador = DB::table('users')->where('carrera_id','=',$carrera->id)->count(); ?>
					<td> {{ $contador }} </td>
					<td>{{ $carrera->name }}</td>
					<td>{{ $carrera->codigo_carrera }}</td>
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
	{!! $carreras->render() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection
