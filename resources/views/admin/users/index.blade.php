@extends('admin.template.main')

@section('title','Lista de Usuarios')

@section('content')
<a href="{{ route('admin.users.create') }}" class="btn btn-info">Registrar nuevo Usuario</a><br><br><br><br>
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
						@if($user->type_id == "1")
							<span class="label label-danger">Tipo de Prueba</span>
						@endif
					</td>
					<td><a href="" class="btn btn-danger"></a> <a href="" class="btn btn-warning"></a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $users->render() !!}
@endsection