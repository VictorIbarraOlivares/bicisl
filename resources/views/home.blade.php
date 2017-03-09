@extends('template.main')

@section('title','Bienvenido ' )

@section('cuerpo')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default " style="border-color: #009859 !important;">
            <center>
            	<h3 style="font-weight: bold;">Hola  {{ Auth::user()->name }} !</h3>
            	<div class="panel-body">
            	<!--No borrar-->
            	@if (Session::has('flash_notification.message'))
				    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

				        {{ Session::get('flash_notification.message') }}
				    </div>
				@endif
				<!--/No borrar-->
            		@if(Auth::user()->type_id == 2)
						<a href="{{ route('admin.home') }}" class="btn btn-success" title="Continuar"><span class="fa fa-btn fa-sign-in" aria-hidden="true" title="Continuar">&nbsp;Continuar</span></a>
					@elseif(Auth::user()->type_id == 3)
							<a href="{{ route('funcionario.home') }}" class="btn btn-success" title="Continuar"><span class="fa fa-btn fa-sign-in" aria-hidden="true" title="Continuar">&nbsp;Continuar</span></a>
					@elseif(Auth::user()->type_id == 4)
							<a href="{{ route('cliente.home') }}" class="btn btn-success" title="Continuar"><span class="fa fa-btn fa-sign-in" aria-hidden="true" title="Continuar">&nbsp;Continuar</span></a>
					@endif
            	</div>
            </center>
        </div>
    </div>
</div>
@endsection
