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

		<table class="table table-striped">
		<thead>
			<th>Activa</th>
			<th>Dueño</th>
			<th>Descripcion</th>
			<th>Hora Llegada</th>
			<th>Fecha Activa</th>
			<th>Encargado Llegada</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($bikes as $bike)
			<?php
					$encargado = User::find($bike->encargado_a);
					$dueño = User::find($bike->user_id);
					if($bike->activa == 0){ ?>
						<tr style="background-color: #40A3FF;" >
			<?php	}else{ ?>
						<tr >
			<?php	}
				?>
					<td>{{ $bike->activa }}</td>
					<td>{{ $dueño->name }}</td>
					<td>{{ $bike->descripcion }}</td>
					<td>{{ $bike->hora_a }}</td>
					<td>{{ formato_y_m_d($bike->fecha_a) }}</td><!-- invertir fecha -->
					<td>{{ $encargado->name }}</td><!-- mostrar nombre -->
					<td>
			<?php		if($bike->activa == 0){ ?>
						<a href="{{ route('admin.bicicletas.cambiar', $bike->id) }}" class="btn btn-warning" onclick="return confirm('¿Seguro quieres voler a ingresar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Ingresar"><span class="glyphicon glyphicon-download" aria-hidden="true" title="Ingresar"></span></a>
			<?php		}else{ ?>
						<a href="{{ route('admin.bicicletas.cambiar', $bike->id) }}" class="btn btn-warning" onclick="return confirm('¿Seguro quieres retirar la bicicleta? \n Esto Enviara un mail al dueño')" title="Retirar"><span class="glyphicon glyphicon-upload" aria-hidden="true" title="Retirar"></span></a>
			<?php		}
						?>
						
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection