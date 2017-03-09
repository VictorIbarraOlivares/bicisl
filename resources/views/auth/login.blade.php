<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'miBicicletaUTEM')</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
    <!-- DATATABLES -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/Bootsrap-3.3.7/css/bootstrap.min.css') }}"><!--BORRAR A VER SI SIGUE FUNCIONANDO -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables/DataTables-1.10.13/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/DataTables-1.10.13/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/Buttons-1.2.4/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables/Buttons-1.2.4/css/buttons.dataTables.css') }}">
    <!-- FIN DATATABLES -->
    <!-- Para autocompletar -->
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui-1.12.1.custom/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui-1.12.1.custom/jquery-ui.theme.min.css') }}">
    <!-- FIN Para autocompletar -->
    <!--Font-awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--Fin Font-awesome -->
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset('plugins/fancyBox/source/jquery.fancybox.css') }}">
    <!-- Fin Fancybox-->

    @yield('head')
    <style type="text/css">
    
    body {
    /*color: #4080FF;*/
    background-color: #006588 }
    /*
    .panel-default {
    border-color: #009859 !important;
    }
    */
    .panel{
    border: 5px solid transparent !important;
    border-radius: 20px !important;
    }
  </style>
</head>
<body class="container-fluid" style="margin-top: 10%;">
    <!--
    include('template.partials.nav')
    -->
    <!-- login -->
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default " style="border-color: #009859 !important;">
                <center>
                    <h3 style="color: black;">
                    <img alt="25x25" src="{{ asset('images/40px-utemcito-azul.png') }}" style="" width="40" height="40">
                    <span style="color: #009859">Mi</span> Bicicleta Utem
                     <i class="fa fa-bicycle fa-2x" aria-hidden="true" style="color: #006588"></i>
                     </h3>
                </center>
              <div class="panel-body" >
                @if (Session::has('flash_notification.message'))
                    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                        {{ Session::get('flash_notification.message') }}
                    </div>
                @endif
                <div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="ejemplo@utem.cl">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Tú Password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-horizontal form-group col-md-12">
                                    <div class="col-md-4 checkbox pull-left">
                                        <label>
                                            <input type="checkbox" name="remember"> Recordarme
                                        </label>
                                    </div>
                                    <div class="col-md-4 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i> Ingresar
                                        </button>
                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <a class="btn btn-link  fa fa-arrow-right" href="{{ url('/password/reset') }}">¿Olvidaste tu Password?</a>
                                   <!-- <a href="{{ url('/register') }}" class="btn btn-info">Crear Cuenta</a> -->
                                </div>
                            </form>
                        </div><!--colmd8-->
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    
    
    <!--/login-->

    <!--
    <footer class="admin-footer" >
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <p class="navbar-text"> <b>Todos los derechos reservados &copy {{ date('Y') }}</b></p>
                    <p class="navbar-text navbar-right"><b>Ing.Sw.2° Semestre</b></p>
                </div>
                
            </div>
        </nav>
        
    </footer>
    -->
<script src="{{ asset('plugins/jquery/js/jquery-2.1.4.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
<!-- DATATABLES-->
<script src="{{ asset('plugins/datatables/DataTables-1.10.13/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/datatables/DataTables-1.10.13/js/jquery.dataTables.js') }}" ></script>
<script src="{{ asset('plugins/datatables/Buttons-1.2.4/js/dataTables.buttons.js') }}"></script>
<script src="{{ asset('plugins/dataTables/Buttons-1.2.4/js/buttons.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/datatables/Buttons-1.2.4/js/buttons.colVis.js') }}"></script>
<!-- FIN DATATABLES -->
<!-- Para autocompletar -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<!-- FIN Para autocompletar -->
<!-- Fancybox -->
<script src="{{ asset('plugins/fancyBox/source/jquery.fancybox.pack.js') }}" ></script>
<!-- Fin Fancybox-->
@yield('script')

    
</body>
</html>