@extends('funcionario.template.main')

@section('title','Editar ' . $title)
@section('head')
<script type="text/javascript">

function mostrar(id){
	if( id == "Alumno"){
		$("#carre").show();
		$('#carrera_id').prop("required",true);
	}else{
		$("#carre").hide();
		$('#carrera_id').removeAttr("required");
	}
	if( id == "Visita"){
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
	{!! Form::open(['route' => ['funcionario.users.update',$user ] , 'method' => 'PUT' , 'name' => 'form1' , 'id' => 'form1']) !!}

		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('nombre', 'Nombre') !!}
					{!! Form::text('nombre',  $nombre ,['class' => 'form-control', 'placeholder' => 'Ingrese Nombre' ,'required']) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('apellido', 'Apellido') !!}
					{!! Form::text('apellido',  $apellido ,['class' => 'form-control', 'placeholder' => 'Ingrese Apellido' ,'required']) !!}
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					{!! Form::label('rut', 'Rut') !!}
					{!! Form::text('rut', formato_rut($user->rut) ,['class' => 'form-control', 'placeholder' => 'Ingrese RUT' ,'required','onblur' => 'return Rut(form1.rut.value)']) !!}
				</div>
			</div>
			<div class="col-md-4">
					<div class="form-group">
					{!! Form::label('email', 'Correo Electronico') !!}
					{!! Form::email('email', $user->email ,['class' => 'form-control', 'placeholder' => 'example@gmail.com' ]) !!} 
				</div>
			</div>
		</div>
		<br>
		<hr>
		<div class="form-group">
			{!! Form::submit('Editar', ['class' => 'btn btn-success pull-left']) !!}
		</div>

	{!! Form::close() !!}
	<a href="{{ url()->previous() }}" class=" pull-right btn btn-danger" title="Cancelar">Cancelar</a>
@endsection
@section('script')
<script type="text/javascript">
/*FUNCIONES PARA RUT*/
function revisarDigito(dvr){    
  dv = dvr + ""    
  if( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K'){        
    alert("Debe ingresar un digito verificador valido");        
    document.form1.rut.focus();        
    document.form1.rut.select();        
    return false;    
  }    
  return true;
}

function revisarDigito2(crut){    
  largo = crut.length;    
  if(largo<2){        
    alert("Debe ingresar el rut completo")        
    document.form1.rut.focus();        
    document.form1.rut.select();        
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
        alert("EL rut es incorrecto")        
        document.form1.rut.focus();        
        document.form1.rut.select();        
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
        alert("Debe ingresar el rut completo")        
        document.form1.rut.focus();        
        document.form1.rut.select();        
        return false;    
    }    

    for (i=0; i < largo ; i++ ){            
        if ( texto.charAt(i) !="0" && texto.charAt(i) != "1" && texto.charAt(i) !="2" && texto.charAt(i) != "3" && texto.charAt(i) != "4" && texto.charAt(i) !="5" && texto.charAt(i) != "6" && texto.charAt(i) != "7" && texto.charAt(i) !="8" && texto.charAt(i) != "9" && texto.charAt(i) !="k" && texto.charAt(i) != "K" ){            
            alert("El valor ingresado no corresponde a un R.U.T valido");            
            document.form1.rut.focus();            
            document.form1.rut.select();            
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

    if(revisarDigito2(texto))        
        return true;    
    return false; 
}
/*FIN FUNCIONES PARA RUT */
</script>
@endsection