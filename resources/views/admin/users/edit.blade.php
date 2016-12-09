@extends('admin.template.main')

@section('title','Editar usuario ' . $user->name)

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

				<option selected="selected" value="{{ $auxId }}">{{ $auxName }}</option>
				@foreach($types as $type)
					@if($type->id != $user->type_id)
						<option value="{{$type->id }}">{{ $type->name }}</option>
					@endif
				@endforeach
			</select>
		</div>

		@if($user->type_id == 2 || $user->type_id == 3)
			<div class="form-group">
			{!! Form::label('carrera_id','Carrera') !!}
				<select class="form-control" required="required" id="carrera_id" name="carrera_id">
					<option selected="selected" value="{{ $auxIdCarrera }}">{{ $auxNameCarrera }}</option>
				</select>
			</div>
		@else
			<div class="form-group">
			{!! Form::label('carrera_id','Carrera') !!}
				<select class="form-control" required="required" id="carrera_id" name="carrera_id">
					<option selected="selected" value="{{ $auxIdCarrera }}">{{ $auxNameCarrera }}</option>
					@foreach($carreras as $carrera)
						@if($carrera->id != $user->carrera_id && $carrera->id != 16)
							<option value="{{$carrera->id }}">{{ $carrera->name }}</option>
						@endif
					@endforeach
				</select>
			</div>

		@endif

		
		<br>
		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
@endsection