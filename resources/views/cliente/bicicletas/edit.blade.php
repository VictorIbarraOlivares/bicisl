
@extends('cliente.template.main')


@section('title','Editar bicicleta de : '. $user->name)

@section('head')
<script type="text/javascript">

</script>
@endsection

@section('content')
	{!! Form::open(['route' => ['cliente.bicicletas.update',$bike ], 'method' => 'PUT', 'files' => true ]) !!}

				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
								{!! Form::label('image', 'Imagen de Bicicleta') !!}
								<img src="{{ asset($image->name)}}" class="img-resposive">

				    			{!! Form::file('image', null, ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							{!! Form::label('detalle', 'Detalles') !!}
							{!! Form::textArea('detalle', $bike->detalle ,['class' => 'form-control', 'placeholder' => 'Detalles de la bicicleta : modelo, numero de serie, etc']) !!}
						</div>
					</div>
				</div>
		<br>
		<hr>
		<div class="form-group">
			{!! Form::submit('Listo', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}

	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection
