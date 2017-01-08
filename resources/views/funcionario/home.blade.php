@php 
use App\User;
function formato_y_m_d($fecha)
{
	$particiones = explode("-", $fecha);
	$fecha = $particiones[2]."-".$particiones[1]."-".$particiones[0];
 	return $fecha;
}
@endphp
@extends('funcionario.template.main')

@section('title','Bicicletas en la Universidad')

@section('head')

@endsection

@section('content')
		<!--Buscador de "clientes" -->
		{!! Form::open(['route' => 'funcionario.bicicletas.ingreso', 'method' => 'get']) !!}
				{{ Form::text('q','',['id' => 'q','placeholder' => 'Buscar Cliente...','required']) }}
				<input type="hidden" name="valor" id="valor" autocomplete="on">
				{!! Form::submit('Ingresar llegada' ,['class' => 'btn btn-danger']) !!}
		{!! Form::close() !!}
		<!--Fin del buscador -->
		<br><br>
		<!-- prueba fancybox -->
		<!--
		 <a class="single-image" href="{{ asset('images/UTEM.png') }}" ><img src="{{ asset('images/UTEM.png') }}" style="width: 10%;height: 14%"></a>
		 -->
		<!-- fin prueba -->
		
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
					<td>
						@if($bike->activa == 0)
						<!-- SE QUITA ESTO, SOLO SE PUEDE INGRESAR MEDIANTE EL BOTON DE INGRESO
							<a href="{{ route('funcionario.bicicletas.cambiar', $bike->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro quieres voler a ingresar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Ingresar"><span class="glyphicon glyphicon-download" aria-hidden="true" title="Ingresar"></span></a>
							-->
						@else
							<a href="{{ route('funcionario.bicicletas.cambiar', $bike->id) }}" class="btn btn-success" onclick="return confirm('¿Seguro quieres retirar la bicicleta? \n Esto Enviara un mail al dueño')" title="Retirar"><span class="glyphicon glyphicon-upload" aria-hidden="true" title="Retirar"></span></a>
							

						@endif
						@if($bike->nota != "")
                    		<a href="{{ route('funcionario.bicicletas.note', $bike->id) }}" class="btn btn-info fancybox fancybox.ajax" title="Ver nota"><span class="glyphicon glyphicon-file" title="Ver nota"></span></a>
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
		source: "{{ route('funcionario.users.autocomplete') }}",
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