
@extends('cliente.template.main')


@section('title','Editar bicicleta de : '. $user->name)

@section('head')
<script type="text/javascript">

</script>
@endsection

@section('content')
	{!! Form::open(['route' => ['cliente.bicicletas.update',$bike ], 'method' => 'PUT' ]) !!}
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('detalle', 'Detalles') !!}
					{!! Form::textArea('detalle', $bike->detalle ,['class' => 'form-control', 'placeholder' => 'Detalles de la bicicleta : modelo, numero de serie, etc']) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
						{!! Form::label('image', 'Imagen de Bicicleta') !!}
		    			{!! Form::file('image', null) !!}
				</div>
			</div>
		</div>
		<br>
		<hr>
		<div class="form-group">
			{!! Form::submit('Listo', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection
