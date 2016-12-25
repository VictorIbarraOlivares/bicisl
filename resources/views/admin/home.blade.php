<?php use App\User;
function formato_y_m_d($fecha){
	$particiones = explode("-", $fecha);
	$fecha = $particiones[2]."-".$particiones[1]."-".$particiones[0];
 	return $fecha;
}
?>
@extends('admin.template.main')

@section('title','Bicicletas en la Universidad')

@section('content')
		<form>
			SECTOR PARA INGRESAR NUEVA LLEGADA
		</form>
		<br>
		<br>

		<table class="table" width="100%" cellpadding="0" cellspacing="0" id="datatable_bike_u">
		<thead>
			<th>Dueño</th>
			<th>Activa</th>
			<th>Descripcion</th>
			<th>Hora Llegada</th>
			<th>Fecha Llegada</th>
			<th>Encargado Llegada</th>
			<th>Hora Salida</th>
			<th>Fecha Salida</th>
			<th>Encargado Salida</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($bikes as $bike)
			<?php
					$encargadoLLegada = User::find($bike->encargado_a);
					if($bike->encargado_s != 0){
						$encargadoSalida = User::find($bike->encargado_s);
						$aux=1;
					}else{
						$aux=0;
					}
					
					$dueño = User::find($bike->user_id);
					if($bike->activa == 0){ ?>
						<tr style="background-color: #069993;" >
			<?php	}else{ ?>
						<tr >
			<?php	}
				?>
					<td>{{ $dueño->name }}</td>
					<td>{{ $bike->activa }}</td>
					<td>{{ $bike->descripcion }}</td>
					<td>{{ $bike->hora_a }}</td>
					<td>{{ formato_y_m_d($bike->fecha_a) }}</td><!-- invertir fecha -->
					<td>{{ $encargadoLLegada->name }}</td><!-- mostrar nombre -->
					<td>{{ $bike->hora_s }}</td>
					<td>{{ formato_y_m_d($bike->fecha_s) }}</td>
					<td>
						@if($aux == 1)
						  	{{ $encargadoSalida->name }}
						@else
							No registra salida
						@endif
					</td>
					<td>
						@if($bike->activa == 0)
							<a href="{{ route('admin.bicicletas.cambiar', $bike->id) }}" class="btn btn-warning" onclick="return confirm('¿Seguro quieres voler a ingresar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Ingresar"><span class="glyphicon glyphicon-download" aria-hidden="true" title="Ingresar"></span></a>
						@else
							<a href="{{ route('admin.bicicletas.cambiar', $bike->id) }}" class="btn btn-warning" onclick="return confirm('¿Seguro quieres retirar la bicicleta? \n Esto Enviara un mail al dueño')" title="Retirar"><span class="glyphicon glyphicon-upload" aria-hidden="true" title="Retirar"></span></a>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('#datatable_bike_u').DataTable({
    	"order": false,
    	"ordering": false,
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