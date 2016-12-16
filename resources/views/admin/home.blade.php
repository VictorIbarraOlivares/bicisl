@extends('admin.template.main')

@section('title','Vista bicicleta')

@section('content')

		{{ var_dump($bicis) }}
		<table class="table table-striped">
		<thead>
			<th>Activa</th>
			<th>Descripcion</th>
			<th>Fecha Activa</th>
			<th>Encargado Llegada</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($bicis as $bike)
				<tr>
					<td style="background-color: red;">{{ $bike->activa }}</td>
					<td>{{ $bike->descripcion }}</td>
					<td>{{ $bike->fecha_a }}</td><!-- invertir fecha -->
					<td>{{ $bike->encargado_a }}</td><!-- mostrar nombre -->
					<td>
						<a href="{{ route('admin.bicicletas.edit', $bike->id) }}" class="btn btn-warning" onclick="return confirm('¿Seguro quieres editar? \n Esto puede afectar al registro de Bicicletas en la Universidad')" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar"></span></a>
						<a href="{{ route('admin.bicicletas.destroy', $bike->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro quieres ELIMINAR? \n No se podra recuperar la informacion de la Bicicleta')" title="Eliminar"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" title="Eliminar"></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection