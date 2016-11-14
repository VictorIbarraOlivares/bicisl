@extends('admin.template.main')

@section('title','Crear Usuario')

@section('content')
	{!! Form::open(['route' => 'admin.users.store', 'method' => 'POST', 'style' => 'center']) !!}

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
			{!! Form::email('email', 'NULL' ,['class' => 'form-control', 'placeholder' => 'example@gmail.com' ,'required']) !!} <!-- No deberia ser requerido para los funcionarios -->
		</div>

		<div class="form-group">
			{!! Form::label('password', 'Contraseña') !!}
			{!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña para el usuario' ,'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('type_id','Tipo') !!}
			{!! Form::select('type_id',['1' => 'Tipo de prueba', '2' => 'Funcionario/Usuario(aun no creado este tipo)', '3' => 'Admin(Aun no creado este tipo)'],null, ['class' => 'form-control','required', 'placeholder' => 'Seleccione un tipo de usuario']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
@endsection