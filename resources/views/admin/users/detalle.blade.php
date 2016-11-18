@extends('admin.template.main')

@section('title','Detalles de  ' . $user->name)

@section('content')
	{!! Form::open(['route' => ['admin.users.update',$user ] , 'method' => 'PUT']) !!}

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name',  $user->name ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('rut', 'Rut') !!}
			{!! Form::text('rut', $user->rut ,['class' => 'form-control','readonly'=>'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'Correo Electronico') !!}
			{!! Form::text('email', $user->email ,['class' => 'form-control' ,'readonly'=>'readonly']) !!} <!-- No deberia ser requerido para los funcionarios -->
		</div>


		<div class="form-group">
			{!! Form::label('type_id','Tipo') !!}
			{!! Form::text('type_name',  $type->name ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
@endsection