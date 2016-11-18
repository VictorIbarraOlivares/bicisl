@extends('admin.template.main')

@section('title','Detalles de  ' . $user->name)

@section('content')
	{!! Form::open(['route' => ['admin.users.update',$user ] , 'method' => 'PUT']) !!}

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name',  $user->name ,['class' => 'form-control', 'placeholder' => 'Ingrese nombre' ,'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('rut', 'Rut') !!}
			{!! Form::number('rut', $user->rut ,['class' => 'form-control', 'placeholder' => 'Ingrese RUT sin digito verificador' ,'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Correo Electronico') !!}
			{!! Form::email('email', $user->email ,['class' => 'form-control', 'placeholder' => 'example@gmail.com' ,'required']) !!} <!-- No deberia ser requerido para los funcionarios -->
		</div>


		<div class="form-group">
			{!! Form::label('type_id','Tipo') !!}
			<select class="form-control" required="required" id="type_id" name="type_id">
		</div>

		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
@endsection