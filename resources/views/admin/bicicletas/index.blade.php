@extends('admin.template.main')

@section('title','Lista de Bicicletas')
@section('content')
	<table class="table table-striped">
		<thead>
			<th>Dueño</th>
			<th>Activa</th>
			<th>Descripcion</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($bikes as $bike)
				<tr>
					@foreach($users as $user)
						@if($user->id == $bike->user_id)
							<td>
								<a href="{{ route('admin.users.detalle', $user->id ) }}" style="color: black;"  title="{{ $user->name }}">{{ $user->name }}</a>
							</td>
						@endif
					@endforeach
					<td style="background-color: red;">{{ $bike->activa }}</td>
					<td>{{ $bike->descripcion }}</td>
					<td>
						<a href="{{ route('admin.bicicletas.edit', $bike->id) }}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar"></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection