@extends('funcionario.template.main')

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
		<p>Total de personas que pertenecen a esta carrera : {{$contador}} </p>

		<!-- Inicio de tabla de los usuarios -->
		<table class="table table-striped">
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
	<!-- Termino de tabla de los usuarios -->

		<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
	
@endsection