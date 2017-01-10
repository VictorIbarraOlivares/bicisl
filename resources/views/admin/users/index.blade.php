@extends('admin.template.main')

@section('title','Lista de Usuarios')
@section('content')
<a href="{{ route('admin.users.create') }}" class="btn btn-info">Registrar nuevo Usuario</a><br><br><br>
	<table class="table" width="100%" cellpadding="0" cellspacing="0" id="datatable_usuarios">
		<thead>
			<th>Código Carrera</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Tipo</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td align="center">
						@if( $user->type_id == 2 || $user->type_id == 3)
								<a href="#" style="color: black;"  title="Funcionarios">Funcionarios</a>
						@else
							@foreach($carreras as $carrera)
								@if($carrera->id == $user->carrera_id)
									@if($carrera->id == 15 || $carrera->id == 16 || $carrera->id == 17)
										<a href="{{ route('admin.carreras.detalle', $carrera->id ) }}" style="color: black;"  title="{{ $carrera->name }}">{{ $carrera->name }}</a>
									@else
										<a href="{{ route('admin.carreras.detalle', $carrera->id ) }}" style="color: black;"  title="{{ $carrera->name }}">{{ $carrera->codigo_carrera }}</a>
									@endif
								@endif
							@endforeach
						@endif
					</td>
					<td>{{ $user->name }}</td>
					<td>
						@if($user->type_id == 1)
							---------------
						@else
							{{ $user->email }}
						@endif
					</td>
					<td>
						@if($user->type_id == "4")
							<span class="label label-primary">Alumno</span>
						@elseif($user->type_id == "2")
							<span class="label label-danger">Administrador</span>
						@elseif($user->type_id == "3")
							<span class="label label-info">Funcionario</span>
						@else
							<span class="label label-success">Visita</span>
						@endif
					</td>
					<td>
						 <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar"></span></a>
						 @if(Auth::user()->id != $user->id)
								<a href="{{ route('admin.users.destroy', $user->id) }}" onclick="return confirm('¿Seguro que deseas eliminarlo? \n Esto borrara toda la informacion asociada al usuario')" class="btn btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true" title="Eliminar"></span></a>
						@endif
						<a href="{{ route('admin.users.detalle', $user->id) }}" class="btn btn-success" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles"></span></a>
						@if($user->type_id != "2" && $user->type_id != "3")
							<a href="{{ route('admin.bicicletas.create', $user->id) }}" class="btn btn-primary" title="Añadir Bicicleta"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true" title="Añadir Bicicleta"></span></a>
						@endif

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#datatable_usuarios').DataTable({
    	
    });
});

</script>
@endsection