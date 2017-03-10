@extends('funcionario.template.main')

@section('title','Lista de Usuarios')
@section('content')
<a href="{{ route('funcionario.users.create') }}" class="btn btn-info">Registrar nuevo Usuario</a><br><br><br>
	<table class="table display" width="100%" cellpadding="0" cellspacing="0" id="datatable_usuarios">
		<thead>
			<th class="text-center">Carrera</th>
			<th>Nombre</th>
			<th>Email</th>
			<th class="text-center">Tipo</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td class="text-center" >
					<strong>
						@if( $user->tipo == 2 || $user->tipo == 3)
								<a href="#" style="color: #080266;font: bold;"  title="Funcionarios">Funcionarios</a>
						@else
							@if($user->carrera == 15 || $user->carrera == 16 || $user->carrera == 17)
								<a href="{{ route('funcionario.carreras.detalle', $user->carrera ) }}" style="color: #080266;"  title="{{ $user->nomCarrera }}">{{ $user->nomCarrera }}</a>
							@else
								<a href="{{ route('funcionario.carreras.detalle', $user->carrera ) }}" style="color: #080266;"  title="{{ $user->nomCarrera }}">{{ $user->codigo_carrera }}</a>
							@endif
						@endif
					</strong>
					</td>
					<td>{{ $user->name }}</td>
					<td>
						@if($user->tipo == 1)
							---------------
						@else
							{{ $user->email }}
						@endif
					</td>
					<td class="text-center">{{ $user->nomTipo }}</td>
					<td >
						<div class="btn-group" role="group" aria-label="...">
						 @if($user->tipo == 1 || $user->tipo== 4 )
						 	<a href="{{ route('funcionario.users.edit', $user->id) }}" class="btn btn-warning" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar" style="color:black;"></span></a>
						@endif
						<a href="{{ route('funcionario.users.detalle', $user->id) }}" class="btn btn-success" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles" style="color:black;"></span></a>
						@if($user->tipo != "2" && $user->tipo != "3")
							<a title="Añadir Bicicleta" data-role="{{ $user->id }}" class="btn btn-primary agregar-data" data-target="#miModalAgregar" ><i class="fa fa-bicycle" aria-hidden="true" title="Añadir Bicicleta" style="color:black;font-weight: bold;"></i></a>
						@endif
						</div>

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