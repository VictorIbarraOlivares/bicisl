
@extends('cliente.template.main')


@section('title','Editar bicicleta de : '. $user->name)

@section('head')
<script type="text/javascript">

</script>
@endsection

@section('content')
	{!! Form::open(['route' => ['cliente.bicicletas.updateBicicleta',$bike ], 'method' => 'PUT' ]) !!}
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('descripcion', 'Descripcion') !!}
					{!! Form::text('descripcion', $bike->descripcion ,['class' => 'form-control', 'placeholder' => 'Descripcion simple ejemplo : color y tipo' ,'required']) !!}
				</div>
			</div>
		</div>

		<div class="form-group">
			{!! Form::submit('Listo', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection
