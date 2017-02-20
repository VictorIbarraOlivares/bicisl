<center>
<nav class="navbar navbar-default" role="navigation" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="row">
      <div class="col-md-1">
        <div class="navbar-header" >
          <div class="row">
            <div class="col-md-9">
              <a class="navbar-brand"  href="http://www.utem.cl/" target="_blank" title="utem.cl"><img src="{{ asset('images/UTEM.png') }}" class="img-responsive"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-11 pull-left">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" align="center">
          <ul class="nav navbar-nav">
            <li {{ setActive('admin/users') }}><a href="{{route('admin.users.index') }}" class="navbar-link">
                <i class="fa fa-users fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp; Usuarios</a>
            </li>
            <li {{ setActive('admin/carreras') }}><a href="{{ route('admin.carreras.index') }}" class="navbar-link">
                <i class="fa fa-university fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp; Carreras</a>
            </li>
            <li {{ setActive('admin/bicicletas') }}>
                <a href="{{ route('admin.bicicletas.index') }}" class="navbar-link">
                <i class="fa fa-bicycle fa-2x"  aria-hidden="true" style="color: #080266;"></i>&nbsp; Bicicletas</a>
            </li>
            <li><a href="{{ route('admin.users.create') }}" class="navbar-link">
                <i class="fa fa-user-plus fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp; Registrar Nuevo Usuario</a>
            </li>
            <!--opciones-->
            <!--
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Opciones <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('admin.users.create') }}">Registrar Nuevo Usuario</a></li>
                <li><a href="#">Opcion disponible</a></li>
                <li><a href="#">Opcion disponible</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Opcion disponible</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Opcion disponible</a></li>
              </ul>
            </li>
              -->
            <!-- fin opciones -->
          </ul><!--
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>-->
          <ul class="nav navbar-nav navbar-right">
            <li {{ setActive('admin/home') }}><a href="{{ route('admin.home') }}">
                <i class="fa fa-home fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp; Home</a>
            </li>
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Ingresar</a></li>
                <!--<li><a href="{{ url('/register') }}">Crear Cuenta</a></li>-->
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-user-circle fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp;
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                          <a href="{{ route('admin.users.detalle', Auth::user()->id) }}" style="font-size:16px;color: #080266;" title="Ver Perfil"><span class="glyphicon glyphicon-eye-open " style="color: #00956F" aria-hidden="true" title="Ver Perfil"></span>   Ver Perfil</a>
                        </li>
                        <li>
                          <a href="{{ route('admin.users.edit', Auth::user()->id) }}" style="font-size: 16px;color: #080266;" title="Editar Perfil"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color: #080266" title="Editar Perfil"></span>   Editar Perfil</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.password',Auth::user()->id ) }}" style="font-size: 16px;color: #080266;" title="Editar Perfil"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color: #080266" title="Editar Password"></span>   Editar Password</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('/logout') }}" title="Cerrar Sesion" style="font-size: 16px;color: #080266;"><span class="glyphicon glyphicon-exclamation-sign" style="color: #ED1723;" aria-hidden="true" title="Cerrar Sesion"></span>   Cerrar Sesion </a></li>
                        
                    </ul>
                </li>
            @endif
          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </div>
    

    
  </div><!-- /.container-fluid -->
</nav>
</center>