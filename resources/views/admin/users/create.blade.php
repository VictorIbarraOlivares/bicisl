
@extends('admin.template.main')


@section('title','Crear Usuario')

@section('head')
<script type="text/javascript">

function mostrar(id){//no se pedira clave para los "alumnos"
	if( id == 4){
		$("#carre").show();
		$('#carrera_id').prop("required",true);
	}else{
		$("#carre").hide();
		$('#carrera_id').removeAttr("required");
	}
	if( id == 1){
		$("#mail").hide();
		$("#email").removeAttr("required");
	}else{
		$("#mail").show();
		$("#email").prop("required",true);
	}
	if( id == 1 || id == 4){//no se pedira clave para los "alumnos" y visita
		$("#clave").hide();
		$("#password").removeAttr("required");
	}else{
		$("#clave").show();
		$("#password").prop("required",true);
	}
}

</script>
@endsection

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
	{!! Form::open(['route' => 'admin.users.store', 'method' => 'POST' , 'name' => 'creando']) !!}

		<div class="form-group">
			{!! Form::label('type_id','Tipo') !!}
			

			<select class="form-control" id="type_id" name="type_id" onchange="mostrar(this.value);" >
				<option selected="selected" required value="">Seleccione un tipo de usuario</option>
				@foreach($types as $type)
				<option value="{{$type->id }}">{{ $type->name }}</option>
				@endforeach
			</select>
		</div>
		
		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name', null ,['class' => 'form-control', 'placeholder' => 'Ingrese nombre y apellido' ,'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('rut', 'Rut') !!}
			{!! Form::number('rut', null ,['class' => 'form-control', 'placeholder' => 'Ingrese RUT sin digito verificador' ,'required']) !!}
		</div>

		<div class="form-group" id="mail">
			{!! Form::label('email', 'Correo Electronico') !!}
			{!! Form::email('email', NULL ,['class' => 'form-control', 'placeholder' => 'ejemplo@gmail.com']) !!} 
		</div>

		<div class="form-group" id="clave">
			{!! Form::label('password', 'Contraseña') !!}
			{!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña para el usuario' ,'required']) !!}
		</div>

		<div class="form-group" id="carre" style="display: none;">
			{!! Form::label('carrera_id','Carrera  (en caso de no ser estudiante seleccione la opción)') !!}
			

			<select class="form-control" id="carrera_id" name="carrera_id" required >
				<option selected="selected" value="">Seleccione la carrera a la que pertenece el Alumno</option>
				@foreach($carreras as $carrera)
					@if($carrera->id != 16 && $carrera->id != 17)
						<option value="{{$carrera->id }}">{{ $carrera->name }}</option>
					@endif
				@endforeach
			</select>
		</div>

		<div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection
