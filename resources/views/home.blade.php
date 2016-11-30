@extends('template.main')



@section('title','Has ingresado correctamente '. Auth::user()->name )

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-5">
            
                @if(Auth::user()->type_id == 2)
						<a href="{{ route('admin.home') }}" class="btn btn-primary" title="Continuar"><span class="fa fa-btn fa-sign-in" aria-hidden="true" title="Continuar">Continuar</span></a>
				@elseif(Auth::user()->type_id == 3)
						<a href="{{ route('funcionario.home') }}" class="btn btn-success" title="Continuar"><span class="fa fa-btn fa-sign-in" aria-hidden="true" title="Continuar">Continuar</span></a>
				@endif
            
        </div>
    </div>
</div>
@endsection
