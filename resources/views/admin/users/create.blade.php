
@extends('admin.template.main')


@section('title','Crear Usuario')

@section('content')

	@if(count($errors) > 0)
		<div class="alert alert-danger" role="alert">
			<ul>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				@foreach($errors->all() as $error)
					<li>{{ $error }} </li>
				@endforeach
			</ul>
		</div>
	@endif
	{!! Form::open(['route' => 'admin.users.store', 'method' => 'POST']) !!}

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name', null ,['class' => 'form-control', 'placeholder' => 'Ingrese nombre' ,'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('rut', 'Rut') !!}
			{!! Form::number('rut', null ,['class' => 'form-control', 'placeholder' => 'Ingrese RUT sin digito verificador' ,'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Correo Electronico') !!}
			{!! Form::email('email', 'null@null.cl' ,['class' => 'form-control', 'placeholder' => 'example@gmail.com']) !!} 
		</div>

		<div class="form-group">
			{!! Form::label('password', 'Contraseña') !!}
			{!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña para el usuario' ,'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('type_id','Tipo') !!}
			

			<select class="form-control" required="required" id="type_id" name="type_id">
				<option selected="selected" value="">Seleccione un tipo de usuario</option>
				@foreach($types as $type)
				<option value="{{$type->id }}">{{ $type->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
@endsection