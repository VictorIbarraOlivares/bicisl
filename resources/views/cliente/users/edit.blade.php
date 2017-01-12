@extends('cliente.template.main')

@section('title','Editar ' . $title)

@section('content')
	{!! Form::open(['route' => ['cliente.users.update',$user ] , 'method' => 'PUT' , 'name' => 'form1' , 'id' => 'form1']) !!}

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('nombre', 'Nombre') !!}
					{!! Form::text('nombre',  $nombre ,['class' => 'form-control', 'placeholder' => 'Ingrese Nombre' ,'required']) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('apellido', 'Apellido') !!}
					{!! Form::text('apellido',  $apellido ,['class' => 'form-control', 'placeholder' => 'Ingrese Apellido' ,'required']) !!}
				</div>
			</div>

			<div class="col-md-4">
				@if($user->type_id != 1)
					<div class="form-group" id="mail" style="display: show;">
				@else
					<div class="form-group" id="mail" style="display: none;">
				@endif
					{!! Form::label('email', 'Correo Electronico') !!}
					{!! Form::email('email', $user->email ,['class' => 'form-control', 'placeholder' => 'example@gmail.com' ]) !!} 
				</div>
			</div>
		</div>
		<br>
		<hr>
		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection