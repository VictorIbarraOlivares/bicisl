@php 
use App\User;
function formato_y_m_d($fecha)
{
	$particiones = explode("-", $fecha);
	$fecha = $particiones[2]."-".$particiones[1]."-".$particiones[0];
 	return $fecha;
}
@endphp
@extends('cliente.template.main')

@section('title','Bicicletas en la Universidad')

@section('head')

@endsection

@section('content')
		
		<hr>
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
			@php
					$hoy = date("Y-m-d");
					$encargadoLLegada = User::find($bike->encargado_a);
					if($bike->encargado_s != 0){
						$encargadoSalida = User::find($bike->encargado_s);
						$aux=1;
					}else{
						$aux=0;
					}

					if($bike->activa == 0){
			@endphp
						<tr style="background-color: #069993;" >
			@php	}else{ @endphp
						<tr >
			@php	}
				@endphp
					<td>{{ $bike->dueño }}</td>
					<td>{{ $bike->activa }}</td>
					<td>{{ $bike->descripcion }}</td>
					<td>{{ $bike->hora_a }}</td>
					<td>{{ formato_y_m_d($bike->fecha_a) }}</td>
					<td>{{ $encargadoLLegada->name }}</td> 
					<td>
						@if($bike->fecha_s != $hoy)
							--:--:--
						@else
							{{ $bike->hora_s }}
						@endif
					</td>
					<td>
						@if($bike->fecha_s != $hoy)
							xx-xx-xxxx
						@else
							{{ formato_y_m_d($bike->fecha_s) }}
						@endif
					</td>
					<td>
						@if($bike->fecha_s != $hoy)
							No registra retiro hoy
						@else
							@if($aux == 1)
						  	{{ $encargadoSalida->name }}
							@else
								No registra salida
							@endif
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
@section('script')
<script type="text/javascript">
/*ejemplo fancybox
$(".single-image").fancybox({
      openEffect : 'elastic',   //'fade', 'elastic'
      closeEffect	: 'elastic',
      openSpeed:'normal', //ms, slow, normal, fast (default 250ms)
      closeSpeed:'normal',
      helpers : {
        title : {
           type : 'inside' //'float', 'inside', 'outside' or 'over'
        },
        overlay : {
          closeClick : true  // if true, se cierra al hacer click fuera de la imagen
        }
    },
    padding:11
});
*/
$(document).ready(function() {
	$(".fancybox").fancybox({
		openEffect: 'elastic',
		closeEffect: 'elastic',
		openSpeed:'fast',
		closeSpeed:'fasst',
		helpers : {
        overlay : {
          closeClick : true  // if true, se cierra al hacer click fuera de la imagen
        }
    },
	});
});
$(function(){
	$("#q").autocomplete({
		source: "{{ route('cliente.users.autocomplete') }}",
		minLength: 2,
		select: function(event, ui){
			$('#q').val(ui.item.value);
			$('#valor').val(ui.item.id);
		}
	});
});
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