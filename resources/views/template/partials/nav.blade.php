<center>
<nav class="navbar navbar-default" >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="row">
      <div class="col-md-1">
        <div class="navbar-header" >
          <div class="row">
            <div class="col-md-8">
              <a class="navbar-brand" href="http://www.utem.cl/" target="_blank" title="utem.cl"><img src="{{ asset('images/UTEM.png') }}" class="img-responsive" ></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-11 pull-left">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" align="center">
          <ul class="nav navbar-nav">
            <li><a href="#">Informacion<span class="sr-only">(current)</span></a></li>
            <li><a href="#">Contacto</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Ingresar</a></li>
                <!--<li><a href="{{ url('/register') }}">Crear Cuenta</a></li> -->
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesion</a></li>
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