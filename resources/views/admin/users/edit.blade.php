@extends('admin.template.main')

@section('title','Editar ' . $title)
@section('head')
<script type="text/javascript">

function mostrar(id){
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

		@if($user->type_id != 1)
			<div class="form-group" id="mail" style="display: show;">
		@else
			<div class="form-group" id="mail" style="display: none;">
		@endif
			{!! Form::label('email', 'Correo Electronico') !!}
			{!! Form::email('email', $user->email ,['class' => 'form-control', 'placeholder' => 'example@gmail.com' ]) !!} 
		</div>


		<div class="form-group">
			{!! Form::label('type_id','Tipo') !!}
			<select class="form-control" required="required" id="type_id" name="type_id" onchange="mostrar(this.value);">

				<option selected="selected" required value="{{ $auxId }}">{{ $auxName }}</option>
				@foreach($types as $type)
					@if($type->id != $user->type_id)
						@if( $auxId == 2 || $auxId == 3)
							@if( $type->id == 2 || $type->id == 3 )
								<option value="{{$type->id }}">{{ $type->name }}</option>
							@endif
						@else
							@if( $auxId == 4 && $type->id == 4 )
								<option value="{{$type->id }}">{{ $type->name }}</option>
							@endif
						@endif
					@endif
				@endforeach
			</select>
		</div>

		@if($user->type_id == 4)
			<div class="form-group" id="carre" style="display: show;">
		@else
			<div class="form-group" id="carre" style="display: none;">
		@endif
		
			{!! Form::label('carrera_id','Carrera (en caso de no ser estudiante seleccione la opción)') !!}
			

			<select class="form-control" id="carrera_id" name="carrera_id" required >
				<option selected="selected" value="{{ $auxIdCarrera }}">{{ $auxNameCarrera }}</option>
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