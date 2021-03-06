@extends('funcionario.template.main')

@section('title','Lista de Carreras')
@section('content')
	<table class="table display" width="100%" cellpadding="0" cellspacing="0" id="datatable_carreras">
		<thead>
			<th>Nombre</th>
			<th>Total Integrantes</th>
			<th>Código</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($carreras as $carrera)
				<tr>
					<td>{{ $carrera->name }}</td>
					@php $contador = DB::table('users')->where('carrera_id','=',$carrera->id)->count(); @endphp
					<td align="center"> {{ $contador }} </td>
					<td align="center">{{ $carrera->codigo_carrera }}</td>
					<td>
						<div class="btn-group" role="group" aria-label="...">
						<a href="{{ route('funcionario.carreras.detalle', $carrera->id ) }}" class="btn btn-success" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles" style="color:black;"></span></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#datatable_carreras').DataTable({
    	
    });
});

</script>
@endsection