
@extends('admin.template.main')


@section('title','Crear Usuario')

@section('head')
<script type="text/javascript">

function mostrar(id){//no se pedira clave para los "alumnos"
	if( id == "Alumno"){
		$("#carre").show();
		$('#carrera').prop("required",true);
	}else{
		$("#carre").hide();
		$('#carrera').removeAttr("required");
	}
	if( id == "Visita"){
		$("#mail").hide();
		$("#email").removeAttr("required");
	}else{
		$("#mail").show();
		$("#email").prop("required",true);
	}
	if( id == "Visita" || id == "Alumno"){//no se pedira clave para los "alumnos" y visita
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
	{!! Form::open(['route' => 'admin.users.store', 'method' => 'POST' , 'name' => 'creando']) !!}
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('type_id','Tipo') !!}
					<select class="form-control" id="tipo" name="tipo" onchange="mostrar(this.value);" >
						<option selected="selected" required >Seleccione un tipo de usuario</option>
						@foreach($types as $type)
						<option value="{{$type->name }}" name="type_name">{{ $type->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('nombre', 'Nombre') !!}
					{!! Form::text('nombre', null ,['class' => 'form-control', 'placeholder' => 'Ingrese Nombre' ,'required']) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('apellido','Apellido') !!}
					{!! Form::text('apellido',null,['class' => 'form-control','placeholder' => 'Ingrese Apellido','required']) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('rut', 'Rut') !!}
					{!! Form::number('rut', null ,['class' => 'form-control', 'placeholder' => 'Ingrese RUT sin digito verificador' ,'required']) !!}
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group" id="mail">
					{!! Form::label('email', 'Correo Electronico') !!}
					{!! Form::email('email', NULL ,['class' => 'form-control', 'placeholder' => 'ejemplo@gmail.com']) !!} 
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-3">
				<div class="form-group" id="clave">
					{!! Form::label('password', 'Contraseña') !!}
					{!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña para el usuario' ,'required']) !!}
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group" id="carre" style="display: none;">
					{!! Form::label('carrera_id','Carrera  (en caso de no ser estudiante seleccione la opción)') !!}
					

					<select class="form-control" id="carrera" name="carrera" required >
						<option selected="selected" value="">Seleccione la carrera a la que pertenece el Alumno</option>
						@foreach($carreras as $carrera)
							@if($carrera->id != 16 && $carrera->id != 17)
								<option value="{{$carrera->id }}">{{ $carrera->name }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<hr>
		

		<div class="form-group">
			{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection
