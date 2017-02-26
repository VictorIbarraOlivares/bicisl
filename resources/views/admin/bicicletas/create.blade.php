
@extends('admin.template.main')


@section('title','Crear bicicleta para '. $user->name)

@section('head')
<script type="text/javascript">

function datos(id){
	if( id == 0){
		$("#notas").hide();
		$('#fecha_activa').hide();
		$('#hora_activa').hide();
		$('#encargado_activa').hide();
	}if( id == 1){
		$("#notas").show();
		$('#fecha_activa').show();
		$('#hora_activa').show();
		$('#encargado_activa').show();
	}
}

</script>
@endsection

@section('content')
	{!! Form::open(['route' => 'admin.bicicletas.store', 'method' => 'POST' , 'name' => 'creando']) !!}
		<h5 class="form-section"><strong>Descripcion para Bicicleta<strong></h5>
		<br>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group form-inline">
					{!! Form::label('color', 'Color') !!}
					{!! Form::text('color', null ,['class' => 'form-control letras', 'placeholder' => 'Ingrese Color' ,'required','style' => 'width: 90%' , 'onkeyup' => 'validaColor();']) !!}
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
					{!! Form::text('tipo',null,['class' => 'form-control letras','placeholder' => 'ej:montaña','required','style' => 'width: 90%' , 'onkeyup' => 'validaTipo();']) !!}
					<p hidden id="checkTipo"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                    <p hidden  id="timesTipo"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
				<p hidden id="mensajeTipo1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 5 caracteres</p>
                <p hidden id="mensajeTipo2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 10 caracteres</p>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group form-inline" id='notas' ">
					{!! Form::label('nota', 'Nota para Bicicleta') !!}
					{!! Form::text('nota', null ,['class' => 'form-control', 'placeholder' => 'Nota para bicicleta en caso que sea necesario','style' => 'width: 90%' , 'onkeyup' => 'validaNota();']) !!}
					<p hidden id="checkNota"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                    <p hidden  id="timesNota"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
				<p hidden id="mensajeNota1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 4 caracteres</p>
                <p hidden id="mensajeNota2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 30 caracteres</p>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<p><strong>Opción : </strong></p>
			<input name='activa' type='radio' value='1' checked="checked"  title="Significa que la bicicleta esta en la Universidad" >Bicicleta Activa</input>
		</div>

		<h5 class="form-section"><strong>Detalles Ingreso a la Universidad<strong></h5>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group" id='fecha_activa' ">
					{!! Form::label('fecha_a', 'Fecha') !!}
					{!! Form::text('fecha_a', date("d-m-Y") ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='hora_activa' " >
					{!! Form::label('hora_a', 'Hora') !!}
					{!! Form::text('hora_a', date("H:i:s",time()) ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group" id='encargado_activa' ">
					{!! Form::label('encargado_a', 'Encargado del ingreso') !!}
					{!! Form::text('encargado_activa', $encargado->name ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
					{!! Form::text('encargado_a', $encargado->id ,['class' => 'form-control', 'style' => 'display:none']) !!}
				</div>
			</div>
			
		</div>
		

		

		

		<div class="form-group" style="display: none;">
		{!! Form::label('user_id', 'Le pertenece a ') !!}
			{!! Form::text('user_id', $user->id ,['class' => 'form-control', 'readonly' => 'readonly']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Listo', ['class' => 'btn btn-success pull-left' ]) !!}
		</div>

	{!! Form::close() !!}

	
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-danger" title="Volver">Cancelar</a>
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