@extends('funcionario.template.main')

@section('title','Lista de Carreras')
@section('content')
	<table class="table table-striped">
		<thead>
			<th>Nombre</th>
			<th>Código</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($carreras as $carrera)
				<tr>
					<td>{{ $carrera->name }}</td>
					<td>{{ $carrera->codigo_carrera }}</td>
					<td>
						 
						<a href="{{ route('funcionario.carreras.detalle', $carrera->id ) }}" class="btn btn-success" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles"></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{!! $carreras->render() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection
