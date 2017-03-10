@php 
use App\User;

@endphp
@extends('cliente.template.main')

@section('title','Mi Bicicleta en la Universidad Hoy '.date("d-m-y"))

@section('head')

@endsection

@section('content')
		
		<hr>
		<table class="table table-responsive" width="100%" cellpadding="0" cellspacing="0" id="datatable_bike_u">
		<thead>
			<th style="width: 5%;">Dueño</th>
			<th style="width: 5%;text-align: center;">Activa</th>
			<th style="width: 5%;">Descripcion</th>
			<th style="width: 5%;text-align: center;">Encargado Llegada</th>
			<th style="width: 5%;text-align: center;">Hora Llegada</th>
			<th style="width: 5%;text-align: center;">Encargado Salida</th>
			<th style="width: 5%;text-align: center;">Hora Salida</th>
		</thead>
		<tbody>
			@php
				$cont = 0;
			@endphp
			@foreach($bikes as $bike)
				@php
					if($bike->activa == 1){
						$cont++;
					}
				@endphp
				@if($bike->user_id == $user->id)
					@php
							$hoy = date("Y-m-d");
							if($bike->activa == 0){
					@endphp
								<tr style="background-color: #069993;" >
					@php	}else{ @endphp
								<tr >
					@php	}
						@endphp
							<td>{{ $bike->dueño }}</td>
							<td style="text-align: center;">
								@if($bike->activa == 1)
								Si
								@else
								No
								@endif
							</td>
							<td>{{ $bike->descripcion }}</td>
							@php
								$encargado_a = User::find($bike->encargado_a);
							@endphp
							<td style="text-align: center;">{{ $encargado_a->name }}</td> 
							<td style="text-align: center;">{{ $bike->hora_a }}</td> 
							<td style="text-align: center;">
								@if($bike->fecha_s != $hoy)
									--------</td>
									<td style="text-align: center;">--:--:--</td>
								@else
									@php
										$encargado_s = User::find($bike->encargado_s);
									@endphp
									{{ $encargado_s->name }}</td>
									<td style="text-align: center;">{{ $bike->hora_s }}</td> 
								@endif
							</td>
						</tr>
				@endif
			@endforeach
		</tbody>
	</table>
	<b>Total de Bicicletas en la Universidad: {{ $cont }}</b>
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