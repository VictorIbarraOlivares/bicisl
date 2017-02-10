@extends('funcionario.template.main')

@section('title','Lista de Usuarios')
@section('content')
<a href="{{ route('funcionario.users.create') }}" class="btn btn-info">Registrar nuevo Usuario</a><br><br><br>
	<table class="table display" width="100%" cellpadding="0" cellspacing="0" id="datatable_usuarios">
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
										<a href="{{ route('funcionario.carreras.detalle', $carrera->id ) }}" style="color: black;"  title="{{ $carrera->name }}">{{ $carrera->name }}</a>
									@else
										<a href="{{ route('funcionario.carreras.detalle', $carrera->id ) }}" style="color: black;"  title="{{ $carrera->name }}">{{ $carrera->codigo_carrera }}</a>
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
						@if($user->type_id == 1 || $user->type_id == 4 )
						 	<a href="{{ route('funcionario.users.edit', $user->id) }}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar"></span></a>
						@endif
						<a href="{{ route('funcionario.users.detalle', $user->id) }}" class="btn btn-success" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles"></span></a>
						@if($user->type_id != "2" && $user->type_id != "3")
							<a title="Añadir Bicicleta" data-role="{{ $user->id }}" class="btn btn-primary agregar-data" data-target="#miModalAgregar" ><i class="fa fa-bicycle" aria-hidden="true" title="Añadir Bicicleta"></i></a>
						@endif

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
<div id="modal"></div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
	$(".agregar-data").click(function(){
            var data = $(this).data("role");
            $.get( "users/agregar/" + data, function( data ) {            	
                $( "#modal" ).html( data );
                //$("#miModalRetiro").modal("hide");
                //$("#miModalRetiro").modal("toggle");
                $( "#miModalAgregar" ).modal();
            });
        });
    $('#datatable_usuarios').DataTable({
    	
    });
});

</script>
@endsection