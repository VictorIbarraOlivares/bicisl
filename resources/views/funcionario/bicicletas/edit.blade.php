
@extends('funcionario.template.main')


@section('title','Editar bicicleta de : '. $user->name)

@section('head')
<script type="text/javascript">

function datos(id,valor){
	if( id != valor){
		if(id == 1){
			//se activan las opciones de nueva activa
			$("#titleI").show();
			$("#notasN").show();
			$('#fecha_activaN').show();
			$('#hora_activaN').show();
			$('#encargado_activaN').show();
			//se desactivan las opciones antiguas
			$('#titleSA').hide();
			$('#fecha_salida').hide();
			$('#hora_salida').hide();
			$('#encargado_salida').hide();
			$('#titleIA').hide();
			$("#notas").hide();
			$('#fecha_activa').hide();
			$('#hora_activa').hide();
			$('#encargado_activa').hide();
			//se desactivan las opciones nueva salida
			$('#titleS').hide();
			$('#fecha_salidaN').hide();
			$('#hora_salidaN').hide();
			$('#encargado_salidaN').hide();
		}
		if(id == 0){
			//se activan las opciones nueva salida
			$('#titleS').show();
			$('#fecha_salidaN').show();
			$('#hora_salidaN').show();
			$('#encargado_salidaN').show();
			//se desactivan las opciones antiguas
			$('#titleSA').hide();
			$('#fecha_salida').hide();
			$('#hora_salida').hide();
			$('#encargado_salida').hide();
			$('#titleIA').hide();
			$("#notas").hide();
			$('#fecha_activa').hide();
			$('#hora_activa').hide();
			$('#encargado_activa').hide();
			//se desactivan las opciones de nueva activa
			$("#titleI").hide();
			$("#notasN").hide();
			$('#fecha_activaN').hide();
			$('#hora_activaN').hide();
			$('#encargado_activaN').hide();
		}
	}if( id == valor){
		if(id == 1){
			$("#notas").show();
			$('#titleIA').show();
			$('#fecha_activa').show();
			$('#hora_activa').show();
			$('#encargado_activa').show();
			$('#titleSA').hide();
			$('#fecha_salida').hide();
			$('#hora_salida').hide();
			$('#encargado_salida').hide();
			//se desactivan las opciones nueva salida
			$('#titleS').hide();
			$('#fecha_salidaN').hide();
			$('#hora_salidaN').hide();
			$('#encargado_salidaN').hide();
			//se desactivan las opciones de nueva activa
			$("#titleI").hide();
			$("#notasN").hide();
			$('#fecha_activaN').hide();
			$('#hora_activaN').hide();
			$('#encargado_activaN').hide();
		}
		if(id == 0){
			$("#notas").hide();
			$('#titleIA').hide();
			$('#fecha_activa').hide();
			$('#hora_activa').hide();
			$('#encargado_activa').hide();
			$('#titleSA').show();
			$('#fecha_salida').show();
			$('#hora_salida').show();
			$('#encargado_salida').show();
			//se desactivan las opciones nueva salida
			$('#titleS').hide();
			$('#fecha_salidaN').hide();
			$('#hora_salidaN').hide();
			$('#encargado_salidaN').hide();
			//se desactivan las opciones de nueva activa
			$("#titleI").hide();
			$("#notasN").hide();
			$('#fecha_activaN').hide();
			$('#hora_activaN').hide();
			$('#encargado_activaN').hide();
		}
	}
}

</script>
@endsection

@section('content')
	{!! Form::open(['route' => ['funcionario.bicicletas.update',$bike ], 'method' => 'PUT' ]) !!}
	<h5 class="form-section"><strong>Descripcion para Bicicleta<strong></h5>
	<div class="row">
			<div class="col-md-4">
				<div class="form-group form-inline">
					{!! Form::label('color', 'Color') !!}
					{!! Form::text('color', trim($descripcion[0]) ,['class' => 'form-control letras', 'placeholder' => 'Ingrese Color' ,'required','style' => 'width: 90%' , 'onkeyup' => 'validaColor();']) !!}
					<p hidden id="checkColor"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                	<p hidden  id="timesColor"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
				<p hidden id="mensajeColor1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 4 caracteres</p>
            	<p hidden id="mensajeColor2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 10 caracteres</p>
			</div>
			<div class="col-md-4">
				<div class="form-group form-inline">
					{!! Form::label('tipo','Tipo') !!}
					<br>
					{!! Form::text('tipo',trim($descripcion[1]),['class' => 'form-control letras','placeholder' => 'ej:montaña','required','style' => 'width: 90%' , 'onkeyup' => 'validaTipo();']) !!}
					<p hidden id="checkTipo"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                	<p hidden  id="timesTipo"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
				<p hidden id="mensajeTipo1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 5 caracteres</p>
            	<p hidden id="mensajeTipo2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 10 caracteres</p>
			</div>
		</div>
	<div class="row">
		@if($bike->activa == 1)
		<div class="col-md-4">
			<div class="form-group form-inline" id='notas' style="display: show;">
				{!! Form::label('nota', 'Nota para Bicicleta') !!}
				{!! Form::text('nota', $bike->nota ,['class' => 'form-control', 'placeholder' => 'Ingrese nota en caso que sea necesario','style' => 'width: 90%' , 'onkeyup' => 'validaNota();']) !!}
				<p hidden id="checkNota"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                <p hidden  id="timesNota"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
			</div>
			<p hidden id="mensajeNota1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 4 caracteres</p>
            <p hidden id="mensajeNota2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 30 caracteres</p>
		</div>
		@endif
	</div>

		
	<strong><p>Elija una opcion :</p></strong>
	<div class="form-group">
	@if($bike->activa == 1)<!-- ESTE IF ES PARA MOSTRAR INFO DEPENDIENDO SI ESTA ACTIVA O NO -->
		<div class="row">
			<div class="col-md-3">
				<input name='activa' type='radio' value='0'  onclick="datos(this.value,1)" title="Significa que la bicicleta NO esta en la Universidad" >Bicicleta no Activa</input>
			</div>
			<div class="col-md-3">
				<input name='activa' type='radio' value='1' checked="checked" onclick="datos(this.value,1)" title="Significa que la bicicleta esta en la Universidad" >Bicicleta Activa</input>
			</div>
		</div>
		<!--CODIGO PARA ACTIVA -->
		<hr>
		<h5 class="form-section" id="titleIA"><strong>Detalles último Ingreso a la Universidad</strong></h5>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group" id='fecha_activa' style="display: show;">
					{!! Form::label('fecha_a', 'Fecha ') !!}
					{!! Form::text('fecha_a', $bike->fecha_a ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='hora_activa' style="display: show;" >
					{!! Form::label('hora_a', 'Hora') !!}
					{!! Form::text('hora_a', $bike->hora_a ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='encargado_activa' style="display: show;">
					{!! Form::label('encargado_a', 'Encargado') !!}
					{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
		</div>		
		<!-- FIN CODIGO PARA ACTIVA -->				
		@else
		<div class="row">
			<div class="col-md-3">
				<input name='activa' type='radio' value='0' checked="checked" onclick="datos(this.value,0)" title="Significa que la bicicleta NO esta en la Universidad" >Bicicleta no Activa</input>
				<br>
			</div>
			<div class="col-md-3">
				<input name='activa' type='radio' value='1'  onclick="datos(this.value,0)" title="Significa que la bicicleta esta en la Universidad" >Bicicleta Activa</input>
			</div>
		</div>
		<hr>
		<h5 class="form-section" id="titleSA"><strong>Detalles última Salida de la Universidad<strong></h5>	
		<!-- CODIGO NO ACTIVA -->
		<div class="row">
			<div class="col-md-4">
				<div class="form-group" id='fecha_salida' style="display: show;">
					{!! Form::label('fecha_s', 'Fecha') !!}
					{!! Form::text('fecha_salida', $bike->fecha_s ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='hora_salida' style="display: show;" >
					{!! Form::label('hora_s', 'Hora') !!}
					{!! Form::text('hora_salida', $bike->hora_s ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='encargado_salida' style="display: show;">
					{!! Form::label('encargado_s', 'Encargado') !!}
					{!! Form::text('encargado_salida', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
		</div>
		@endif
		<!-- CODIGO CAMBIO DE ESTADO-->
		<!--CODIGO PARA ACTIVA -->
		<h5 class="form-section" id='titleI' style="display: none;"><strong>Detalles nuevo Ingreso a la Universidad<strong></h5>
		<div class="row">
			<div class="col-md-5">
				<div class="form-group" id='notasN' style="display: none;">
					{!! Form::label('nota', 'Nueva Nota') !!}
					{!! Form::text('notaNueva',null  ,['class' => 'form-control', 'placeholder' => 'Ingrese alguna nota sobre la bicicleta en caso que sea necesario']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group" id='fecha_activaN' style="display: none;">
					{!! Form::label('fecha_a', 'Nueva Fecha') !!}
					{!! Form::text('fecha_a', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='hora_activaN' style="display: none;" >
					{!! Form::label('hora_a', 'Nueva Hora') !!}
					{!! Form::text('hora_a',date("H:i:s",time()) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='encargado_activaN' style="display: none;">
					{!! Form::label('encargado_a', 'Nuevo Encargado') !!}
					{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
		</div>
		<!--CODIGO PARA NO ACTIVA -->
		<h5 class="form-section" id="titleS" style="display: none;"><strong>Detalles nueva Salida de la Universidad<strong></h5>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group" id='fecha_salidaN' style="display: none;">
					{!! Form::label('fecha_s', 'Nueva Fecha') !!}
					{!! Form::text('fecha_salida', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='hora_salidaN' style="display: none;" >
					{!! Form::label('hora_s', 'Nueva Hora') !!}
					{!! Form::text('hora_salida', date("H:i:s",time()),['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='encargado_salidaN' style="display: none;">
					{!! Form::label('encargado_s', 'Nuevo Encargado') !!}
					{!! Form::text('encargado_salida', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
		</div>
	</div>
	<!--FIN CODIGO CAMBIO DE ESTADO -->
		<div class="form-group">
			{!! Form::submit('Listo', ['class' => 'btn btn-success pull-left']) !!}
		</div>

	{!! Form::close() !!}

	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Cancelar">Cancelar</a>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    /*Con esto no se deja ingresar nada que no sea letras*/
    $(".letras").keypress(function (key) {
            window.console.log(key.charCode)
            if (
                (key.charCode < 97 || key.charCode > 122)//letras mayusculas
                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
                && (key.charCode != 0) //borrar y enter
                && (key.charCode != 241) //ñ
                 && (key.charCode != 209) //Ñ
                 && (key.charCode != 225) //á
                 && (key.charCode != 233) //é
                 && (key.charCode != 237) //í
                 && (key.charCode != 243) //ó
                 && (key.charCode != 250) //ú
                 && (key.charCode != 193) //Á
                 && (key.charCode != 201) //É
                 && (key.charCode != 205) //Í
                 && (key.charCode != 211) //Ó
                 && (key.charCode != 218) //Ú
                )
                //console.log(key.charCode);
                return false;
    });
    /*fin letras*/

    
    
});




/*FUNCION PARA VALIDAR EL COLOR*/
function validaColor(){

    if($("#color").val().length < 4) {  
        $('#mensajeColor1').removeAttr("hidden");
        $('#mensajeColor2').attr("hidden","hidden");
        $('#color').css("border-color","#ED1723");
        agregaIconosColor();
    }else if($("#color").val().length > 10){
        $('#mensajeColor1').attr("hidden","hidden");
        $('#mensajeColor2').removeAttr("hidden");
        $('#color').css("border-color","#ED1723");
        agregaIconosColor();
    }else{
        $('#mensajeColor1').attr("hidden","hidden");
        $('#mensajeColor2').attr("hidden","hidden");
        $('#color').css("border-color","#5A956F");
        quitaIconosColor();
    }
}
function agregaIconosColor()
{
    $('#timesColor').removeAttr("hidden");
    $('#timesColor').css("display","inline");
    $('#checkColor').attr("hidden","hidden");
    $('#checkColor').css("display","none");
}

function quitaIconosColor()
{
    $('#checkColor').removeAttr("hidden");
    $('#checkColor').css("display","inline");
    $('#timesColor').attr("hidden","hidden");
    $('#timesColor').css("display","none");
}
/*FIN FUNCION PARA VALIDAR EL COLOR*/

/*FUNCION PARA VALIDAR EL TIPO*/
function validaTipo(){

    if($("#tipo").val().length < 5) {  
        $('#mensajeTipo2').attr("hidden","hidden");
        $('#mensajeTipo1').removeAttr("hidden");
        $('#tipo').css("border-color","#ED1723");
        agregarIconosTipo();
    }else if($("#tipo").val().length > 10){
        $('#mensajeTipo1').attr("hidden","hidden");
        $('#mensajeTipo2').removeAttr("hidden");
        $('#tipo').css("border-color","#ED1723");
        agregarIconosTipo();
    }else{
        $('#mensajeTipo1').attr("hidden","hidden");
        $('#mensajeTipo2').attr("hidden","hidden");
        $('#tipo').css("border-color","#5A956F");
        quitaIconosTipo();
    }
}
function agregarIconosTipo()
{
    $('#timesTipo').removeAttr("hidden");
    $('#timesTipo').css("display","inline");
    $('#checkTipo').attr("hidden","hidden");
    $('#checkTipo').css("display","none");
}

function quitaIconosTipo()
{
    $('#checkTipo').removeAttr("hidden");
    $('#checkTipo').css("display","inline");
    $('#timesTipo').attr("hidden","hidden");
    $('#timesTipo').css("display","none");
}
/*FIN FUNCION PARA VALIDAR EL TIPO*/

/*FUNCION PARA VALIDAR LA NOTA*/
function validaNota(){

    if($("#nota").val().length < 4) {  
        $('#mensajeNota2').attr("hidden","hidden");
        $('#mensajeNota1').removeAttr("hidden");
        $('#nota').css("border-color","#ED1723");
        agregarIconosNota();
    }else if($("#nota").val().length > 30){
        $('#mensajeNota1').attr("hidden","hidden");
        $('#mensajeNota2').removeAttr("hidden");
        $('#nota').css("border-color","#ED1723");
        agregarIconosNota();
    }else{
        $('#mensajeNota1').attr("hidden","hidden");
        $('#mensajeNota2').attr("hidden","hidden");
        $('#nota').css("border-color","#5A956F");
        quitaIconosNota();
    }
}
function agregarIconosNota()
{
    $('#timesNota').removeAttr("hidden");
    $('#timesNota').css("display","inline");
    $('#checkNota').attr("hidden","hidden");
    $('#checkNota').css("display","none");
}

function quitaIconosNota()
{
    $('#checkNota').removeAttr("hidden");
    $('#checkNota').css("display","inline");
    $('#timesNota').attr("hidden","hidden");
    $('#timesNota').css("display","none");
}
/*FIN FUNCION PARA VALIDAR LA NOTA*/



</script>
@endsection