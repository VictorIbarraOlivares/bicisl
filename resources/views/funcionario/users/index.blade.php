@extends('funcionario.template.main')


@section('title','Lista de Usuarios')
@section('content')
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Tipo</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>
						@if($user->type_id == "4")
							<span class="label label-primary">Alumno</span>
						@else
							<span class="label label-success">Tipo de Prueba</span>
						@endif
					</td>
					<td>
						 
						<a href="{{ route('funcionario.users.detalle', $user->id) }}" class="btn btn-success" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles"></span></a>

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $users->render() !!}
@endsection