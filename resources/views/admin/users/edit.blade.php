@extends('admin.template.main')

@section('title','Editar ' . $title)
@section('head')
<script type="text/javascript">

function mostrar(id){
	if( id == 1 || id == 4){
		$("#carre").show();
		$('#carrera_id').prop("required",true);
	}else{
		$("#carre").hide();
		$('#carrera_id').removeAttr("required");
	}
}

</script>
@endsection

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
			<select class="form-control" required="required" id="type_id" name="type_id" onchange="mostrar(this.value);">

				<option selected="selected" required value="{{ $auxId }}">{{ $auxName }}</option>
				@foreach($types as $type)
					@if($type->id != $user->type_id)
						<option value="{{$type->id }}">{{ $type->name }}</option>
					@endif
				@endforeach
			</select>
		</div>

		<div class="form-group" id="carre" style="display: none;">
			{!! Form::label('carrera_id','Carrera (en caso de no ser estudiante seleccione la opción)') !!}
			

			<select class="form-control" id="carrera_id" name="carrera_id" required >
				@if($auxId == 2 || $auxId == 3 )
					<option selected="selected" required value="">Seleccione un tipo de usuario</option>
				@else
					<option selected="selected" value="{{ $auxIdCarrera }}">{{ $auxNameCarrera }}</option>
				@endif
				@foreach($carreras as $carrera)
					@if($carrera->id != 16 && $carrera->id != $user->carrera_id)
						<option value="{{$carrera->id }}">{{ $carrera->name }}</option>
					@endif
				@endforeach
			</select>
		</div>

		
		<br>
		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection