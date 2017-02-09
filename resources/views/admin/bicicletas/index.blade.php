@extends('admin.template.main')

@section('title','Lista de Bicicletas')
@section('content')
	<table class="table display" width="100%" cellpadding="0" cellspacing="0" id="datatable_bicicletas">
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
					<td>{{ $bike->activa }}</td>
					<td>{{ $bike->descripcion }}</td>
					<td>
						<a title="Editar" data-role="{{ $bike->id }}" class="btn btn-warning editar-data" data-target="#miModalEditar" ><i class="fa fa-pencil" aria-hidden="true" title="Editar"></i></a>
						<a href="{{ route('admin.bicicletas.detalle', $bike->id) }}" class="btn btn-info" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles"></span></a>
						@if($bike->activa == 0)
							<a title="Eliminar" data-role="{{ $bike->id }}" class="btn btn-danger eliminar-data" data-target="#miModalEliminar" ><i class="fa fa-trash" aria-hidden="true" title="Eliminar"></i></a>
							<a href="{{ route('admin.bicicletas.cambiar', $bike->id) }}" class="btn btn-primary" onclick="return confirm('¿Seguro quieres voler a ingresar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Ingresar"><span class="glyphicon glyphicon-download" aria-hidden="true" title="Ingresar"></span></a>
						@else
							<a href="{{ route('admin.bicicletas.cambiar', $bike->id) }}" class="btn btn-success" onclick="return confirm('¿Seguro quieres retirar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Retirar"><span class="glyphicon glyphicon-upload" aria-hidden="true" title="Retirar"></span></a>
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
	$(".eliminar-data").click(function(){
            var data = $(this).data("role");
            $.get( "bicicletas/eliminar/" + data, function( data ) {            	
                $( "#modal" ).html( data );
                //$("#miModalRetiro").modal("hide");
                //$("#miModalRetiro").modal("toggle");
                $( "#miModalEliminar" ).modal();
            });
        });
	$(".editar-data").click(function(){
            var data = $(this).data("role");
            $.get( "bicicletas/editar/" + data, function( data ) {            	
                $( "#modal" ).html( data );
                //$("#miModalRetiro").modal("hide");
                //$("#miModalRetiro").modal("toggle");
                $( "#miModalEditar" ).modal();
            });
        });
    $('#datatable_bicicletas').DataTable({
    	dom: 'Bfrtip',
    	stateSave: true,
        LengthMenu: [
        	[ 10 , 25 , 50 , 100 ],
        	[ '10' , '25', '50' , '100']
        ],
        buttons: [
            {
            	text: 'Ocular Columnas',
                extend: 'colvis',
                columns: ':not(:first-child)'
            },
            {
            	text: 'Mostrar Registros',
            	extend: 'pageLength'
            }
        ]
    });
});

</script>
@endsection