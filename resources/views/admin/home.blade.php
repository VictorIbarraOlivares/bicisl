@php 
use App\User;
@endphp
@extends('admin.template.main')

@section('title','Bicicletas en la Universidad')

@section('head')

@endsection

@section('content')
	<div class="row">
			<!--Buscador de "clientes" -->
			{!! Form::open(['route' => 'admin.bicicletas.ingreso', 'method' => 'get']) !!}
			<input type="hidden" name="valor" id="valor" autocomplete="on">
	    <div class="col-md-3">			
			{{ Form::text('q','',['id' => 'q','placeholder' => 'Buscar Cliente...','required','class' => 'form-control']) }}
		</div>
		<div class="col-md-2">
			{!! Form::submit('Ingresar llegada' ,['class' => 'btn btn-danger']) !!}
		</div>
			{!! Form::close() !!}
				<!--Fin del buscador -->
		<div class="col-md-4">
			<a href="{{ route('admin.users.create') }}" class="btn btn-success">Registrar nuevo Usuario e Ingresar Bicicleta</a>
		</div>
	</div>
	
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
							<a href="{{ route('admin.bicicletas.cambiar', $bike->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro quieres voler a ingresar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Ingresar"><span class="glyphicon glyphicon-download" aria-hidden="true" title="Ingresar"></span></a>
							-->
						@else
							<a href="{{ route('admin.bicicletas.cambiar', $bike->id) }}" class="btn btn-danger" onclick="return confirm('¿Seguro quieres retirar la bicicleta? \n Esto Enviara un mail al dueño')" title="Retirar"><i class="fa fa-bicycle fa-2x"  aria-hidden="true" style="color:black;" title="Retirar"></i>&nbsp; Retirar</a>
						@endif
						@if($bike->nota != "")
							<!--CODIGO QUE SIRVE PARA LA IMAGEN -->
							<!--
                    		<a href="{{ route('admin.bicicletas.note', $bike->id) }}" class="btn btn-info fancybox fancybox.ajax" title="Ver nota"><span class="glyphicon glyphicon-file" title="Ver nota"></span></a>
                    		-->
                    		<!--FIN CODIGO QUE SIRVE PARA LA IMAGEN -->
                    		<a id="sample_editable_1_new" title="Ver Nota" data-role="1" class="btn btn-info option-data" data-toggle="modal" data-target="#miModalNota" >
                    		<i class="fa fa-comment fa-2x" aria-hidden="true" title="Ver nota"></i>&nbsp; Nota
                    		</a>
						@endif

					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<!-- INICIO MODAL NOTA -->
	<div class="modal fade" id="miModalNota" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" title="Cerrar" class="close" data-dismiss="modal" aria-hidden="true"><strong>x</strong></button>
					<h4 class="modal-title">Nota de Bicicleta</h4>
		                <div class="row">
		                <hr>
		                    <div class="modal-body">
		                        <div class="form-group">
		                            <div class="col-md-12">
		                                <div class="form-group">
										{!! Form::text('nota', @$bike->nota ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
										</div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <div class="modal-footer">
		                    <button class="btn btn-warning" title="Volver" data-dismiss="modal" aria-hidden="true"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp; Volver</button>
		                </div>

				</div>
			</div>
		</div>
	 </div>
	 <!-- FIN MODAL NOTA -->
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
		source: "{{ route('admin.users.autocomplete') }}",
		minLength: 2,
		select: function(event, ui){
			$('#q').val(ui.item.value);
			$('#valor').val(ui.item.id);
		}
	});
});
$(document).ready(function(){
    $('#datatable_bike_u').DataTable({
    	responsive: true,
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