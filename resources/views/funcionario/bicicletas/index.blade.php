@extends('funcionario.template.main')

@section('title','Lista de Bicicletas')
@section('content')
	<table class="table" width="100%" cellpadding="0" cellspacing="0" id="datatable_bicicletas">
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
								<a href="{{ route('funcionario.users.detalle', $user->id ) }}" style="color: black;"  title="{{ $user->name }}">{{ $user->name }}</a>
							</td>
						@endif
					@endforeach
					<td>{{ $bike->activa }}</td>
					<td>{{ $bike->descripcion }}</td>
					<td>
						<a href="{{ route('funcionario.bicicletas.edit', $bike->id) }}" class="btn btn-warning" onclick="return confirm('¿Seguro quieres editar? \n Esto puede afectar al registro de Bicicletas en la Universidad')" title="Editar"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar"></span></a>

						<a href="{{ route('funcionario.bicicletas.detalle', $bike->id) }}" class="btn btn-info" title="Detalles"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" title="Detalles"></span></a>
						@if($bike->activa == 0)
							<a href="{{ route('funcionario.bicicletas.cambiar', $bike->id) }}" class="btn btn-primary" onclick="return confirm('¿Seguro quieres voler a ingresar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Ingresar"><span class="glyphicon glyphicon-download" aria-hidden="true" title="Ingresar"></span></a>
						@else
							<a href="{{ route('funcionario.bicicletas.cambiar', $bike->id) }}" class="btn btn-success" onclick="return confirm('¿Seguro quieres retirar la bicicleta? \n Esto afectara al registro de Bicicletas en la Universidad')" title="Retirar"><span class="glyphicon glyphicon-upload" aria-hidden="true" title="Retirar"></span></a>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
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