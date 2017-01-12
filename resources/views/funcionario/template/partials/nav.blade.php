<center>
<nav class="navbar navbar-default" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header" >
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://www.utem.cl/" target="_blank" title="utem.cl"><img src="{{ asset('images/UTEM.png') }}" style="width: 140%;height: 140%"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" align="center">
      <ul class="nav navbar-nav">
        <li {{ setActive('funcionario/users') }}><a href="{{route('funcionario.users.index') }}" class="navbar-link">
            <i class="fa fa-users fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp; Usuarios</a>
        </li>
        <li {{ setActive('funcionario/carreras') }}><a href="{{ route('funcionario.carreras.index') }}" class="navbar-link"><i class="fa fa-university fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp; Carreras</a>
        </li>
        <li {{ setActive('funcionario/bicicletas') }}><a href="{{ route('funcionario.bicicletas.index') }}" class="navbar-link"><i class="fa fa-bicycle fa-2x"  aria-hidden="true" style="color: #080266;"></i>&nbsp; Bicicletas</a>
        </li>
        <li><a href="{{ route('funcionario.users.create') }}" class="navbar-link"><i class="fa fa-user-plus fa-2x"  aria-hidden="true" style="color: #080266;"></i>&nbsp; Registrar Nuevo Usuario</a>

        <!--opciones-->
        <!--
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('funcionario.users.create') }}">Registrar Nuevo Usuario</a></li>
            <li><a href="#">Opcion disponible</a></li>
            <li><a href="#">Opcion disponible</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Opcion disponible</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Opcion disponible</a></li>
          </ul>
        </li>
        -->
        <!--fin opciones-->
      </ul><!--
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>-->
      <ul class="nav navbar-nav navbar-right">
        <li {{ setActive('funcionario/home') }}><a href="{{ route('funcionario.home') }}"><i class="fa fa-home fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp; Home</a>
        </li>
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Ingresar</a>
            </li>
            <!--<li><a href="{{ url('/register') }}">Crear Cuenta</a></li>-->
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user-circle fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp;
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('funcionario.users.detalle', Auth::user()->id) }}" style="font-size:16px;" title="Ver Perfil">
                    <span class="glyphicon glyphicon-eye-open " style="color: #54CC14" aria-hidden="true" title="Ver Perfil"></span>   Ver Perfil</a></li>
                    <li><a href="{{ route('funcionario.users.edit', Auth::user()->id) }}" style="font-size: 16px" title="Editar Perfil">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color: #313AFF" title="Editar Perfil"></span>   Editar Perfil</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ url('/logout') }}" title="Cerrar Sesion" style="font-size: 16px;"><span class="glyphicon glyphicon-exclamation-sign" style="color: #FF0000;" aria-hidden="true" title="Cerrar Sesion"></span>   Cerrar Sesion </a></li>
                    
                </ul>
            </li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</center>