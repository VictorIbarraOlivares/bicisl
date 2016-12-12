@extends('admin.template.main')

@section('title','Lista de Bicicletas')
@section('content')
	<table class="table table-striped">
		<thead>
			<th>id user bicicleta</th>
			<th>Activa ?</th>
		</thead>
		<tbody>
			@foreach($bikes as $bike)
				<tr>
					<td>{{ $bike->id }}</td>
					<td>{{ $bike->activa }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection