@extends('admin.template.main')

@section('title','Editar carrera ' . $carrera->name)

@section('content')
	{!! Form::open(['route' => ['admin.carreras.update',$carrera ] , 'method' => 'PUT']) !!}

		<div class="row">
			<div class="col-md-5">
				<div class="form-group form-inline">
					{!! Form::label('nombre', 'Nombre') !!}
					{!! Form::text('nombre',  $carrera->name ,['class' => 'form-control letras', 'placeholder' => 'Ingrese nombre' ,'required','style' => 'width: 90%' , 'onkeyup' => 'validaNombre();']) !!}
					<p hidden id="checkNombre"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                    <p hidden  id="timesNombre"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
				<p hidden id="mensajeNombre1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 8 caracteres</p>
                <p hidden id="mensajeNombre2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 35 caracteres</p>
			</div>
			<div class="col-md-4">
				<div class="form-group form-inline">
					{!! Form::label('codigo_carrera', 'Código Carrera') !!}
					{!! Form::number('codigo_carrera', $carrera->codigo_carrera ,['class' => 'form-control numeros', 'placeholder' => 'Ingrese código carrera' ,'required','style' => 'width:90%' , 'onkeyup' => 'validaCodigo();']) !!}
					<p hidden id="checkCodigo"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                    <p hidden  id="timesCodigo"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
				<p hidden id="mensajeCodigo1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 4 caracteres</p>
                <p hidden id="mensajeCodigo2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 7 caracteres</p>
			</div>
			
		</div>
		
		<hr>
		

		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-primary pull-left']) !!}
		</div>		

	{!! Form::close() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-primary" title="Volver">Volver</a>
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
                 && (key.charCode != 32) //space
                )
                //console.log(key.charCode);
                return false;
    });
    /*fin letras*/

    /*Con esto no se deja ingresar nada que no sea letras*/
    $(".numeros").keypress(function (key) {
            window.console.log(key.charCode)
            if (
                (key.charCode < 48 || key.charCode > 57)//números
                && (key.charCode != 0) //borrar y enter
                )
                //console.log(key.charCode);
                return false;
    });
    /*fin letras*/
    
});




/*FUNCION PARA VALIDAR EL NOMBRE*/
function validaNombre(){

    if($("#nombre").val().length < 8) {  
        $('#mensajeNombre1').removeAttr("hidden");
        $('#mensajeNombre2').attr("hidden","hidden");
        $('#nombre').css("border-color","#ED1723");
        agregaIconosNombre();
    }else if($("#nombre").val().length > 35){
        $('#mensajeNombre1').attr("hidden","hidden");
        $('#mensajeNombre2').removeAttr("hidden");
        $('#nombre').css("border-color","#ED1723");
        agregaIconosNombre();
    }else{
        $('#mensajeNombre1').attr("hidden","hidden");
        $('#mensajeNombre2').attr("hidden","hidden");
        $('#nombre').css("border-color","#5A956F");
        quitaIconosNombre();
    }
}
function agregaIconosNombre()
{
    $('#timesNombre').removeAttr("hidden");
    $('#timesNombre').css("display","inline");
    $('#checkNombre').attr("hidden","hidden");
    $('#checkNombre').css("display","none");
}

function quitaIconosNombre()
{
    $('#checkNombre').removeAttr("hidden");
    $('#checkNombre').css("display","inline");
    $('#timesNombre').attr("hidden","hidden");
    $('#timesNombre').css("display","none");
}
/*FIN FUNCION PARA VALIDAR EL NOMBRE*/

/*FUNCION PARA VALIDAR EL CÓDIGO CARRERA*/
function validaCodigo(){

    if($("#codigo_carrera").val().length < 4) {  
        $('#mensajeCodigo2').attr("hidden","hidden");
        $('#mensajeCodigo1').removeAttr("hidden");
        $('#codigo_carrera').css("border-color","#ED1723");
        agregaIconosCodigo();
    }else if($("#codigo_carrera").val().length > 7){
        $('#mensajeCodigo1').attr("hidden","hidden");
        $('#mensajeCodigo2').removeAttr("hidden");
        $('#codigo_carrera').css("border-color","#ED1723");
        agregaIconosCodigo();
    }else{
        $('#mensajeCodigo1').attr("hidden","hidden");
        $('#mensajeCodigo2').attr("hidden","hidden");
        $('#codigo_carrera').css("border-color","#5A956F");
        quitaIconosCodigo();
    }
}
function agregaIconosCodigo()
{
    $('#timesCodigo').removeAttr("hidden");
    $('#timesCodigo').css("display","inline");
    $('#checkCodigo').attr("hidden","hidden");
    $('#checkCodigo').css("display","none");
}

function quitaIconosCodigo()
{
    $('#checkCodigo').removeAttr("hidden");
    $('#checkCodigo').css("display","inline");
    $('#timesCodigo').attr("hidden","hidden");
    $('#timesCodigo').css("display","none");
}
/*FIN FUNCION PARA VALIDAR EL CÓDIGO CARRERA*/


</script>
@endsection