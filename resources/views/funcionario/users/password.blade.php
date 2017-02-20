@extends('funcionario.template.main')

@section('title','Cambio de Password ')

@section('content')
<form class="form-horizontal" method="post" {{ route('funcionario.users.cambiopassword',$user->id) }}>
	<div class="form-group">
        <label class="col-xs-3 control-label">Password</label>
        <div class="col-xs-5">
            <input type="password" class="form-control" name="password" placeholder="Ingrese su password actual" style="width: 90%" required />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Nuevo Password</label>
        <div class="col-xs-5">
        	<div class="form-inline">
            	<input type="password" class="form-control" name="nuevoPassword" id="password" onkeyup="validandoPassword();" style="width: 90%" required>
            	<p hidden id="checkPass"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
            	<p hidden id="timesPass"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
            </div>
            <p hidden id="mensajep" style="color: #ED1723;font-weight:bold;"><i class="fa fa-exclamation" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe tener mínimo 4 caracteres</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Repite el nuevo Password</label>
        <div class="col-xs-5">
        	<div class="form-inline">
        		<input type="password" class="form-control" name="repitePassword" id="confirmPassword" onkeyup="validando();" style="width: 90%" required/>
            	<p hidden id="checkNewPass"><i class="fa fa-check" aria-hidden="true" style="color: #5A956F;"></i></p>
            	<p hidden id="timesNewPass"><i class="fa fa-times" aria-hidden="true" style="color: #ED1723;"></i></p>
        	</div>
            <p hidden id="mensaje" style="color: #ED1723;font-weight:bold;"><i class="fa fa-exclamation" aria-hidden="true" style="color: #ED1723;"></i>&nbsp;Este campo debe ser igual al Nuevo Password</p>
        </div>
        	
    </div>
    <hr>
    <div class="form-group row">
    	<div class="col-md-6">
    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
    		{!! Form::submit('Cambiar', ['class' => 'pull-left btn btn-success']) !!}
    	</div>
    	<div class="col-md-6">
    		<a href="{{ url()->previous() }}" class=" pull-right btn btn-danger" title="Cancelar">Cancelar</a>
    	</div>
	</div>

</form>

@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function() {
});

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

function validandoPassword()
{
	if($("#password").val().length < 4) {  
        $('#mensajep').removeAttr("hidden");
        $('#password').css("border-color","#ED1723");
        agregaIconosPass();
        validando();
    }else{
    	$('#mensajep').attr("hidden","hidden");
    	$('#password').css("border-color","#5A956F");
    	quitaIconosPass();
    	validando();
    }
	
}

function agregaIconosNewPass()
{
	$('#timesNewPass').removeAttr("hidden");
    $('#timesNewPass').css("display","inline");
    $('#checkNewPass').attr("hidden","hidden");
    $('#checkNewPass').css("display","none");
}

function quitaIconosNewPass()
{
	$('#checkNewPass').removeAttr("hidden");
    $('#checkNewPass').css("display","inline");
    $('#timesNewPass').attr("hidden","hidden");
    $('#timesNewPass').css("display","none");
}

function validando()
{

	if( $('#confirmPassword').val() != $('#password').val() ){
		$('#mensaje').removeAttr("hidden");
		$('#confirmPassword').css("border-color","#ED1723");
		agregaIconosNewPass();
	}else{
		$('#mensaje').attr("hidden","hidden");
		$('#confirmPassword').css("border-color","#5A956F");
		quitaIconosNewPass();
	}
	
}
</script>
@endsection