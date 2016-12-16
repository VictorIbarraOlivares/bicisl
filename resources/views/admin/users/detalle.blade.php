@extends('admin.template.main')

@section('title','Detalles ' . $title)

@section('content')

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
			{!! Form::label('type_name','Tipo') !!}
			{!! Form::text('type_name',  $type->name ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>
		@if($type->id == 3 || $type->id == 2)

		@else
			<div class="form-group">
			{!! Form::label('carera_id','Carrera') !!}
			{!! Form::text('carrera_name',  $carrera->name ,['class' => 'form-control' ,'readonly'=>'readonly']) !!}
		</div>

		@endif


		<a href="{{ url()->previous() }}" class="btn btn-primary" title="Volver"><span class="fa fa-btn fa-sign-in" aria-hidden="true" title="Volver">Volver</span></a>

@endsection