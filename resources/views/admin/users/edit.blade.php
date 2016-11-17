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
				@foreach($types as $type)
				  @if($type->id == $user->id)
				  	{!! $auxId=$type->id !!}
				  	{!! $auxName=$type->name !!}
				  @endif
				@endforeach

				<option selected="selected" value="{{ $auxId }}">{{ $auxName }}</option>
				@foreach($types as $type)
					@if($type->id != $user->id)
						<option value="{{$type->id }}">{{ $type->name }}</option>
					@endif
				@endforeach
			</select>
		</div>

		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
@endsection