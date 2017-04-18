@extends('admin.template.main')

@section('title','Lista de Carreras')
@section('content')
<a href="{{ route('admin.carreras.create') }}" class="btn btn-info">Registrar nueva Carrera</a><br><br><br>
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
					<td>
						<p>{{ $carrera->name }}
						@if($carrera->id == 17 )
							(Se Eliminan Diariamente)</p>
						@endif
						@if($carrera->id == 16)
							(Usuarios del Sistema)</p>
						@endif
					</td>
					@php $contador = DB::table('users')->where('carrera_id','=',$carrera->id)->count(); @endphp
					<td align="center"> {{ $contador }} </td>
					<td align="center">{{ $carrera->codigo_carrera }}</td>
					<td>
						<div class="btn-group" role="group" aria-label="...">
					 	<a href="{{ route('admin.carreras.edit', $carrera->id ) }}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar" style="color:black;"></span></a>
					 	@if($carrera->id != 17 && $carrera->id != 16 && $carrera->id != 15)
						<a title="Eliminar" data-role="{{ $carrera->id }}" class="btn btn-danger eliminar-data" data-target="#miModalEliminar" ><i class="fa fa-trash" aria-hidden="true" title="Eliminar" style="color:black;"></i></a>
						@endif
						<a href="{{ route('admin.carreras.detalle', $carrera->id ) }}" class="btn btn-success" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles" style="color:black;"></span></a>
						</div>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
<div id="modal"></div>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
	$(".eliminar-data").click(function(){
            var data = $(this).data("role");
            $.get( "carreras/eliminar/" + data, function( data ) {            	
                $( "#modal" ).html( data );
                //$("#miModalRetiro").modal("hide");
                //$("#miModalRetiro").modal("toggle");
                $( "#miModalEliminar" ).modal();
            });
        });
    $('#datatable_carreras').DataTable({
    	
    });
});

</script>
@endsection