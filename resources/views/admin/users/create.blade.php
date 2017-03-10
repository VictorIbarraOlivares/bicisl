
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
        $('#mensajeEmail1').attr("hidden","hidden");
        $('#mensajeEmail2').attr("hidden","hidden");
        $('#mensajeEmail3').attr("hidden","hidden");
		$("#email").removeAttr("required");
	}else{
		$("#mail").show();
		$("#email").prop("required",true);
	}
	if( id == "Visita" || id == "Alumno"){//no se pedira clave para los "alumnos" y visita
		$("#clave").hide();
        $('#mensajePass1').attr("hidden","hidden");
        $('#mensajePass2').attr("hidden","hidden");
		$("#password").removeAttr("required");
	}else{
		$("#clave").show();
		$("#password").prop("required",true);
	}
}


</script>
@endsection

@section('content')
	{!! Form::open(['route' => 'admin.users.store', 'method' => 'POST' ,'name' => 'form1' ,'id' => 'form1']) !!}
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					{!! Form::label('type_id','Tipo') !!}
					<select class="form-control" id="tipo" name="tipo" onchange="mostrar(this.value);" required>
						<option value="">Seleccione un tipo de usuario</option>
						@foreach($types as $type)
                        @if($type->id == 4)
                          <option value="{{$type->name }}" name="type_name">Dueño Bicicleta</option>  
                        @else
						  <option value="{{$type->name }}" name="type_name">{{ $type->name }}</option>
                        @endif
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group form-inline">
					{!! Form::label('nombre', 'Nombre') !!}
					{!! Form::text('nombre', null ,['class' => 'form-control letras', 'placeholder' => 'Ingrese Nombre' ,'required' ,'style' => 'width: 90%' , 'onkeyup' => 'validaNombre();']) !!}
                    <p hidden id="checkNombre"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                    <p hidden  id="timesNombre"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
                <p hidden id="mensajeNombre1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 2 caracteres</p>
                <p hidden id="mensajeNombre2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 15 caracteres</p>
			</div>
			<div class="col-md-4">
				<div class="form-group form-inline">
					{!! Form::label('apellido','Apellido') !!}
					{!! Form::text('apellido',null,['class' => 'form-control letras','placeholder' => 'Ingrese Apellido','required','style' => 'width: 90%' , 'onkeyup' => 'validaApellido();']) !!}
                    <p hidden id="checkApellido"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                    <p hidden  id="timesApellido"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
                <p hidden id="mensajeApellido1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 3 caracteres</p>
                <p hidden id="mensajeApellido2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 15 caracteres</p>
			</div>
			<div class="col-md-4">
				<div class="form-group form-inline">
					{!! Form::label('rut', 'Rut') !!}
                    <br>
					{!! Form::text('rut', null ,['class' => 'form-control', 'placeholder' => 'Ingrese RUT ','required','onblur' => 'return Rut(form1.rut.value)', 'style' => 'width:90%']) !!}
                    <p hidden id="checkRut"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                    <p hidden  id="timesRut"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
                <p hidden id="mensajeRut1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Debe ingresar el rut completo</p>
                <p hidden id="mensajeRut2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Debe ingresar un digito verificador valido</p>
                <p hidden id="mensajeRut3" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;El rut es incorrecto</p>
                <p hidden id="mensajeRut4" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa  fa-exclamation-circle " aria-hidden="true" style="color: #ED1723;"></i>&nbsp;El valor ingresado no corresponde a un rut valido</p>
			</div>
		</div>

		<br>
		<div class="row">
            <div class="col-md-4">
                <div class="form-group form-inline" id="mail">
                    {!! Form::label('email', 'Correo Electronico') !!}
                    {!! Form::email('email', NULL ,['class' => 'form-control', 'placeholder' => 'ejemplo@gmail.com' ,'style' => 'width:90%' , 'onkeyup' => 'validaEmail();']) !!}
                    <p hidden id="checkEmail"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                    <p hidden  id="timesEmail"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p> 
                </div>
                <p hidden id="mensajeEmail1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 6 caracteres</p>
                <p hidden id="mensajeEmail2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 40 caracteres</p>
                <p hidden id="mensajeEmail3" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe ser un email valido</p>
            </div>
			<div class="col-md-4">
				<div class="form-group form-inline" id="clave">
					{!! Form::label('password', 'Contraseña') !!}
					{!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña para el usuario' ,'required' ,'style' => 'width:90%' , 'onkeyup' => 'validaPass();']) !!}
                    <p hidden id="checkPass"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
                    <p hidden  id="timesPass"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
				</div>
                <p hidden id="mensajePass1" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 4 caracteres</p>
                <p hidden id="mensajePass2" style="color: #080266;font-weight:bold;font-size: 90%"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener máximo 30 caracteres</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="form-group" id="carre" style="display: none;">
					{!! Form::label('carrera_id','Carrera,Funcionarios,Profesores') !!}
                    <br>
					<select class="form-control" id="carrera" name="carrera" required style="width: 75%">
						<option value="">Seleccione Según el Dueño</option>
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
			{!! Form::submit('Registrar', ['class' => 'btn btn-success pull-left']) !!}
		</div>

	{!! Form::close() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-danger" title="Cancelar">Cancelar</a>
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
                && (key.charCode != 0) //borrar
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
    
    //validaNombre();
    //validaApellido();
    //validaEmail();
});


/*FUNCIONES PARA RUT*/
function revisarDigito(dvr){    
  dv = dvr + ""    
  if( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K'){
    $('#mensajeRut2').removeAttr("hidden");
    $('#mensajeRut1').attr("hidden","hidden");
    $('#mensajeRut3').attr("hidden","hidden");
    $('#mensajeRut4').attr("hidden","hidden");
    $('#rut').css("border-color","#ED1723");
    agregaIconosRut();    
    //alert("Debe ingresar un digito verificador valido");      
    //document.form1.rut.focus();        
    //document.form1.rut.select();        
    return false;    
  }    
  return true;
}

function revisarDigito2(crut){    
  largo = crut.length;    
  if(largo<2){
    $('#mensajeRut1').removeAttr("hidden");
    $('#mensajeRut2').attr("hidden","hidden");
    $('#mensajeRut3').attr("hidden","hidden");
    $('#mensajeRut4').attr("hidden","hidden");
    $('#rut').css("border-color","#ED1723");
    agregaIconosRut();         
    //alert("Debe ingresar el rut completo")        
    //document.form1.rut.focus();        
    //document.form1.rut.select();        
    return false;    
  }    
  if(largo>2)        
    rut = crut.substring(0, largo - 1);    
  else        
    rut = crut.charAt(0);    
    dv = crut.charAt(largo-1);    
    revisarDigito( dv );    

  if ( rut == null || dv == null )
    return 0    
    var dvr = '0'    
    suma = 0    
    mul  = 2    

    for (i= rut.length -1 ; i >= 0; i--){    
        suma = suma + rut.charAt(i) * mul        
        if (mul == 7)            
            mul = 2        
        else                
            mul++    
    }    
    res = suma % 11    
    if (res==1)        
        dvr = 'k'    
    else if (res==0)        
        dvr = '0'    
    else    
    {        
        dvi = 11-res        
        dvr = dvi + ""    
    }
    if ( dvr != dv.toLowerCase() )    
    {
        $('#mensajeRut3').removeAttr("hidden");
        $('#mensajeRut1').attr("hidden","hidden");
        $('#mensajeRut2').attr("hidden","hidden");
        $('#mensajeRut4').attr("hidden","hidden");
        $('#rut').css("border-color","#ED1723");
        agregaIconosRut(); 
        //alert("EL rut es incorrecto")        
        //document.form1.rut.focus();        
        //document.form1.rut.select();        
        return false    
    }

    return true
}

function Rut(texto){    
  var tmpstr = "";    
  for ( i=0; i < texto.length ; i++ )        
    if ( texto.charAt(i) != ' ' && texto.charAt(i) != '.' && texto.charAt(i) != '-' )
        tmpstr = tmpstr + texto.charAt(i);    
    texto = tmpstr;    
    largo = texto.length;    

    if ( largo < 2 ){
        $('#mensajeRut1').removeAttr("hidden");
        $('#mensajeRut2').attr("hidden","hidden");
        $('#mensajeRut3').attr("hidden","hidden");
        $('#mensajeRut4').attr("hidden","hidden");
        $('#rut').css("border-color","#ED1723");
        agregaIconosRut();        
        //alert("Debe ingresar el rut completo");
        //document.form1.rut.focus();        
        //document.form1.rut.select();        
        return false;    
    }    

    for (i=0; i < largo ; i++ ){            
        if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" ){ 
            $('#mensajeRut4').removeAttr("hidden");
            $('#mensajeRut1').attr("hidden","hidden");
            $('#mensajeRut2').attr("hidden","hidden");
            $('#mensajeRut3').attr("hidden","hidden");
            $('#rut').css("border-color","#ED1723");
            agregaIconosRut();           
            //alert("El valor ingresado no corresponde a un rut valido");            
            //document.form1.rut.focus();            
            //document.form1.rut.select();            
            return false;        
        }    
    }    

    var invertido = "";    
    for ( i=(largo-1),j=0; i>=0; i--,j++ )        
        invertido = invertido + texto.charAt(i);    
    var dtexto = "";    
    dtexto = dtexto + invertido.charAt(0);    
    dtexto = dtexto + '-';    
    cnt = 0;    

    for ( i=1,j=2; i<largo; i++,j++ ){        
        //alert("i=[" + i + "] j=[" + j +"]" );        
        if ( cnt == 3 ){            
            dtexto = dtexto + '.';            
            j++;            
            dtexto = dtexto + invertido.charAt(i);            
            cnt = 1;        
        }else{                
           dtexto = dtexto + invertido.charAt(i);            
           cnt++;        
        }    
    }    

    invertido = "";    
    for ( i=(dtexto.length-1),j=0; i>=0; i--,j++ )        
        invertido = invertido + dtexto.charAt(i);    

    document.form1.rut.value = invertido.toUpperCase();      

    if(revisarDigito2(texto)){
        //ACÁ ESTA TODO BUENO, si se llega hasta acá
        $('#mensajeRut1').attr("hidden","hidden");
        $('#mensajeRut2').attr("hidden","hidden");
        $('#mensajeRut3').attr("hidden","hidden");
        $('#mensajeRut4').attr("hidden","hidden");
        $('#rut').css("border-color","#5A956F");
        quitaIconosRut();
        return true; 
    }else{
        return false;
    }   
     
}

function agregaIconosRut()
{
    $('#timesRut').removeAttr("hidden");
    $('#timesRut').css("display","inline");
    $('#checkRut').attr("hidden","hidden");
    $('#checkRut').css("display","none");
}

function quitaIconosRut()
{
    $('#checkRut').removeAttr("hidden");
    $('#checkRut').css("display","inline");
    $('#timesRut').attr("hidden","hidden");
    $('#timesRut').css("display","none");
}
/*FIN FUNCIONES PARA RUT */

/*FUNCION PARA VALIDAR EL NOMBRE*/
function validaNombre(){

    if($("#nombre").val().length < 2) {  
        $('#mensajeNombre1').removeAttr("hidden");
        $('#mensajeNombre2').attr("hidden","hidden");
        $('#nombre').css("border-color","#ED1723");
        agregaIconosNombre();
    }else if($("#nombre").val().length > 15){
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

/*FUNCION PARA VALIDAR EL APELLIDO*/
function validaApellido(){

    if($("#apellido").val().length < 3) {  
        $('#mensajeApellido2').attr("hidden","hidden");
        $('#mensajeApellido1').removeAttr("hidden");
        $('#apellido').css("border-color","#ED1723");
        agregaIconosApellido();
    }else if($("#apellido").val().length > 15){
        $('#mensajeApellido1').attr("hidden","hidden");
        $('#mensajeApellido2').removeAttr("hidden");
        $('#apellido').css("border-color","#ED1723");
        agregaIconosApellido();
    }else{
        $('#mensajeApellido1').attr("hidden","hidden");
        $('#mensajeApellido2').attr("hidden","hidden");
        $('#apellido').css("border-color","#5A956F");
        quitaIconosApellido();
    }
}
function agregaIconosApellido()
{
    $('#timesApellido').removeAttr("hidden");
    $('#timesApellido').css("display","inline");
    $('#checkApellido').attr("hidden","hidden");
    $('#checkApellido').css("display","none");
}

function quitaIconosApellido()
{
    $('#checkApellido').removeAttr("hidden");
    $('#checkApellido').css("display","inline");
    $('#timesApellido').attr("hidden","hidden");
    $('#timesApellido').css("display","none");
}
/*FIN FUNCION PARA VALIDAR EL APELLIDO*/

/*FUNCION PARA VALIDAR EL EMAIL*/
function validaEmail(){

    /*inico validacion email*/
    var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var valid = re.test($('#email').val());
    /*fin para email*/
    
    if($("#email").val().length < 6) {  
        $('#mensajeEmail2').attr("hidden","hidden");
        $('#mensajeEmail1').removeAttr("hidden");
        $('#email').css("border-color","#ED1723");
        agregaIconosEmail();
    }else if($("#email").val().length > 40){
        $('#mensajeEmail1').attr("hidden","hidden");
        $('#mensajeEmail2').removeAttr("hidden");
        $('#email').css("border-color","#ED1723");
        agregaIconosEmail();
    }else if(!valid){//si no es valido
        $('#mensajeEmail3').removeAttr("hidden");
        $('#mensajeEmail1').attr("hidden","hidden");
        $('#mensajeEmail2').attr("hidden","hidden");
        $('#email').css("border-color","#ED1723");
        agregaIconosEmail();
    }else{
        $('#mensajeEmail1').attr("hidden","hidden");
        $('#mensajeEmail2').attr("hidden","hidden");
        $('#mensajeEmail3').attr("hidden","hidden");
        $('#email').css("border-color","#5A956F");
        quitaIconosEmail();
    }
}
function agregaIconosEmail()
{
    $('#timesEmail').removeAttr("hidden");
    $('#timesEmail').css("display","inline");
    $('#checkEmail').attr("hidden","hidden");
    $('#checkEmail').css("display","none");
}

function quitaIconosEmail()
{
    $('#checkEmail').removeAttr("hidden");
    $('#checkEmail').css("display","inline");
    $('#timesEmail').attr("hidden","hidden");
    $('#timesEmail').css("display","none");
}
/*FIN FUNCION PARA VALIDAR EL EMAIL*/

/*FUNCION PARA VALIDAR EL PASS*/
function validaPass(){

    if($("#password").val().length < 4) {  
        $('#mensajePass2').attr("hidden","hidden");
        $('#mensajePass1').removeAttr("hidden");
        $('#password').css("border-color","#ED1723");
        agregaIconosPass();
    }else if($("#password").val().length > 30){
        $('#mensajePass1').attr("hidden","hidden");
        $('#mensajePass2').removeAttr("hidden");
        $('#password').css("border-color","#ED1723");
        agregaIconosPass();
    }else{
        $('#mensajePass1').attr("hidden","hidden");
        $('#mensajePass2').attr("hidden","hidden");
        $('#password').css("border-color","#5A956F");
        quitaIconosPass();
    }
}
function agregaIconosPass()
{
    $('#timesPass').removeAttr("hidden");
    $('#timesPass').css("display","inline");
    $('#checkPass').attr("hidden","hidden");
    $('#checkPass').css("display","none");
}

function quitaIconosPass()
{
    $('#checkPass').removeAttr("hidden");
    $('#checkPass').css("display","inline");
    $('#timesPass').attr("hidden","hidden");
    $('#timesPass').css("display","none");
}
/*FIN FUNCION PARA VALIDAR EL PAS*/
</script>
@endsection