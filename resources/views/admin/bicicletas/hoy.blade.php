@php 
use App\User;
@endphp
@extends('admin.template.main')

@section('title','Bicicletas en la Universidad Fecha : '. date("d-m-Y"))

@section('head')

@endsection

@section('content')
	<div class="row">

		<div class="col-md-3">
			<a href="{{ route('admin.home') }}" class="btn btn-danger" ><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;Volver</a>
		</div>
	</div>
	
	<br>
	
	<hr>
	<table class="display" width="100%" cellpadding="0" cellspacing="0" id="datatable_bike_u">
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

					if($bike->activa == 1){
			@endphp
						<tr style="background-color: #B9121B;color:white;" >
			@php	}else{ @endphp
						<tr >
			@php	}
				@endphp
					<td>{{ $bike->dueño }}</td>
					<td>
						@if($bike->activa == 1)
							Si
						@else
							No
						@endif
					</td>
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

$(document).ready(function(){
    $('#datatable_bike_u').DataTable({
    	"responsive": true,
    	"bPaginate": false,
    	"order": false,
    	"ordering": false,
    	"bFilter": false,
    	dom: 'Bfrtip',
        buttons: [
            'excel'
        ]
    });
});

</script>
@endsection