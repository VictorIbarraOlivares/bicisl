@extends('admin.template.main')

@section('title','Lista de Usuarios')
@section('content')
<a href="{{ route('admin.users.create') }}" class="btn btn-info">Registrar nuevo Usuario</a><br><br><br>
	<table class="table display" width="100%" cellpadding="0" cellspacing="0" id="datatable_usuarios">
		<thead>
			<th>Nombre</th>
			<th>Carrera,Funcionarios,Profesores</th>
			<th>Email</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td >
						
						<a href="{{ route('admin.carreras.detalle', $user->carrera ) }}" style="color: #080266;"  title="{{ $user->codigo_carrera }}">
							<p>{{ $user->nomCarrera }}
							@if($user->carrera == 17 )
								(Se Eliminan Diariamente)</p>
							@endif
							@if($user->carrera == 16)
								(Usuarios del Sistema)</p>
							@endif
						</a>
						
					</td>
					<td>
						@if($user->tipo == 1)
							---------------
						@else
							{{ $user->email }}
						@endif
					</td>
					<td >
						<!--Div botones-->
						<div class="btn-group" role="group" aria-label="...">
						 <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar" style="color:black;"></span></a>
						 @if(Auth::user()->id != $user->id)
								<a title="Eliminar" data-role="{{ $user->id }}" class="btn btn-danger eliminar-data" data-target="#miModalEliminar" ><i class="fa fa-trash" aria-hidden="true" title="Eliminar" style="color:black;"></i></a>
						@endif
						<a href="{{ route('admin.users.detalle', $user->id) }}" class="btn btn-success" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles" style="color:black;"></span></a>
						@if($user->tipo != "2" && $user->tipo != "3")
							<a title="Añadir Bicicleta" data-role="{{ $user->id }}" class="btn btn-primary agregar-data" data-target="#miModalAgregar" ><i class="fa fa-bicycle" aria-hidden="true" title="Añadir Bicicleta" style="color:black;font-weight: bold;"></i></a>
						@endif
						</div>
						<!--FIN Div Botones -->
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
	$(".eliminar-data").click(function(){
            var data = $(this).data("role");
            $.get( "users/eliminar/" + data, function( data ) {            	
                $( "#modal" ).html( data );
                //$("#miModalRetiro").modal("hide");
                //$("#miModalRetiro").modal("toggle");
                $( "#miModalEliminar" ).modal();
            });
        });
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