@extends('admin.template.main')

@section('title','Detalles de la carrera ' . $carrera->name)

@section('content')

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name',  $carrera->name ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('codigo_carrera', 'Código Carrera') !!}
			{!! Form::text('codigo_carrera', $carrera->codigo_carrera ,['class' => 'form-control','readonly'=>'readonly']) !!}
		</div>
		<p style="font-weight:bold;">Total de personas que pertenecen a esta carrera : {{$contador}} </p>

		<!-- Inicio de tabla de los usuarios -->
		<table class="table" width="100%" cellpadding="0" cellspacing="0" id="datatable_usuarios">
		<thead>
			<th>Rut</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Tipo</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->rut }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
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

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<!-- Termino de tabla de los usuarios -->

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