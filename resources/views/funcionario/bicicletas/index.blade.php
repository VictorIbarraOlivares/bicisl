@extends('funcionario.template.main')

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
					<td>
						<a href="{{ route('funcionario.users.detalle', $bike->usuario ) }}" style="color: black;"  title="{{ $bike->dueño }}">{{ $bike->dueño }}</a>
					</td>
					<td>
						@if($bike->activa == 1)
							<p style="color: #B9121B">Si</p>
						@else
							<p>No</p>
						@endif
					</td>
					<td>{{ $bike->descripcion }}</td>
					<td>
						<div class="btn-group" role="group" aria-label="...">
						<a title="Editar" data-role="{{ $bike->id }}" class="btn btn-warning editar-data" data-target="#miModalEditar" ><i class="fa fa-pencil" aria-hidden="true" title="Editar" style="color:black;"></i></a>

						<a href="{{ route('funcionario.bicicletas.detalle', $bike->id) }}" class="btn btn-info" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles" style="color:black;"></span></a>

						<a title="Imagen" data-role="{{ $bike->id }}" class="btn btn-success imagen-data" data-target="#miModalImagen" ><i class="fa fa-picture-o" aria-hidden="true" title="Imagen" style="color:black;"></i></a>
						@if($bike->activa == 0)
							<!--ESTO ES PARA INGRESAR LA BICICLETA
							<a href="{{ route('funcionario.bicicletas.cambiar', $bike->id) }}" class="btn btn-primary" onclick="return confirm('¿Seguro quieres voler a ingresar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Ingresar"><span class="glyphicon glyphicon-download" aria-hidden="true" title="Ingresar"></span></a>
							-->
						@else
						<!--Para retirar la bicicleta
							<a href="{{ route('funcionario.bicicletas.cambiar', $bike->id) }}" class="btn btn-success" onclick="return confirm('¿Seguro quieres retirar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Retirar"><span class="glyphicon glyphicon-upload" aria-hidden="true" title="Retirar"></span></a>
						-->
							 <a  title="Retirar" data-role="{{ $bike->id }}" class="btn btn-danger optionretiro-data" data-target="#miModalRetiro"><i class="fa fa-bicycle" aria-hidden="true" title="Retirar" style="color:black;font-weight: bold;" ></i></a>

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
	$(".imagen-data").click(function(){
            var data = $(this).data("role");
            $.get( "bicicletas/imagen/" + data, function( data ) {            	
                $( "#modal" ).html( data );
                $( "#miModalImagen" ).modal();
            });
        });
	$(".editar-data").click(function(){
            var data = $(this).data("role");
            $.get( "bicicletas/editar/" + data, function( data ) {            	
                $( "#modal" ).html( data );
                $( "#miModalEditar" ).modal();
            });
        });
	$(".optionretiro-data").click(function(){
            var data = $(this).data("role");
            $.get( "bicicletas/retiro/" + data, function( data ) {            	
                $( "#modal" ).html( data );
                //$("#miModalRetiro").modal("hide");
                //$("#miModalRetiro").modal("toggle");
                $( "#miModalRetiro" ).modal();
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