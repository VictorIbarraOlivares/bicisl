@extends('template.main')
<!-- Main Content -->
@section('content')

@endsection
@section('cuerpo')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default " style="border-color: #009859 !important;">
            <center>
                <h4 style="font-weight: bold;">Restaurar Password</h4>
            </center>
                <div class="panel-body">
                <!--No borrar-->
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <!--/No borrar-->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Tú_email_ejemplo@utem.cl">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Enviar Mail
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <center>
                <p>
                    <h6 style="font-weight: bold;" class="alert alert-danger">
                    <i class="fa fa-exclamation-circle fa-lg" aria-hidden="true"></i>
                    Se enviará un mail para recuperar tu password
                    </h6>
                </p>
                    
                </center>
                
        </div>
    </div>
</div>
@endsection