<center>
<nav class="navbar navbar-default" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="row">
      <div class="col-md-1">
        <div class="navbar-header" >
          <div class="row">
            <div class="col-md-9">
              <a class="navbar-brand" href="http://www.utem.cl/" target="_blank" title="utem.cl"><img src="{{ asset('images/40px-utemcito-azul.png') }}" class="img-responsive"  ></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-11 pull-left">
        <ul class="nav navbar-nav navbar-right">
        <li {{ setActive('cliente/home') }}><a href="{{ route('cliente.home') }}"><i class="fa fa-home fa-2x" aria-hidden="true" style="color: #080266;"></i>&nbsp; Home</a>
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
                    <li><a href="{{ route('cliente.users.detalle', Auth::user()->id) }}" style="font-size:16px;color: #080266;" title="Ver Perfil">
                    <span class="glyphicon glyphicon-eye-open " style="color: #00956F" aria-hidden="true" title="Ver Perfil"></span>   Ver Perfil</a></li>
                    <li><a href="{{ route('cliente.users.edit', Auth::user()->id) }}" style="font-size: 16px;color: #080266;" title="Editar Perfil">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color: #080266" title="Editar Perfil"></span>   Editar Perfil</a></li>
                     <li>
                      <a href="{{ route('cliente.users.password', Auth::user()->id ) }}" style="font-size: 16px;color: #080266;" title="Editar Perfil"><span class="glyphicon glyphicon-pencil" aria-hidden="true" style="color: #080266" title="Editar Password"></span>   Editar Password</a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('cliente.bicicletas.index') }}" style="font-size: 16px" title="Editar Perfil">
                      <span class="fa fa-bicycle" aria-hidden="true" style="color: #080266" title="Editar Perfil"></span>   Mis Bicicletas</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ url('/logout') }}" title="Cerrar Sesion" style="font-size: 16px;color: #080266;"><span class="glyphicon glyphicon-exclamation-sign" style="color: #ED1723;" aria-hidden="true" title="Cerrar Sesion"></span>   Cerrar Sesion </a></li>
                    
                </ul>
            </li>
        @endif
      </ul>
      </div>
    </div>
    

      
    
  </div><!-- /.container-fluid -->
</nav>
</center>

