@extends('cliente.template.main')

@section('title','Lista de Bicicletas')
@section('content')
	<table class="table display" width="100%" cellpadding="0" cellspacing="0" id="datatable_bicicletas">
		<thead>
			<th>Descripción</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($bikes as $bike)
				@if($user->id == $bike->user_id)
					<td>{{ $bike->descripcion }}</td>
					<td>
						<a title="Editar" data-role="{{ $bike->id }}" class="btn btn-warning editar-data" data-target="#miModalEditar" ><i class="fa fa-pencil" aria-hidden="true" title="Editar"></i>&nbsp; Editar</a>

						<a title="Imagen" data-role="{{ $bike->id }}" class="btn btn-success imagen-data" data-target="#miModalImagen" ><i class="fa fa-picture-o" aria-hidden="true" title="Imagen"></i>&nbsp; Ver Imagen</a>
				</tr>
				@endif
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
	                //$("#miModalRetiro").modal("hide");
	                //$("#miModalRetiro").modal("toggle");
	                $( "#miModalEditar" ).modal();
	        });
	    });
});

</script>
@endsection