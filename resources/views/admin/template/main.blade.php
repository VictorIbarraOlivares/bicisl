<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', 'Default') | Panel de Administración</title>
	<link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables/Bootsrap-3.3.7/css/bootstrap.min.css') }}"><!--BORRAR A VER SI SIGUE FUNCIONANDO -->
	<link rel="stylesheet" href="{{ asset('plugins/datatables/DataTables-1.10.13/css/jquery.dataTables.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables/DataTables-1.10.13/css/dataTables.bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables/Buttons-1.2.4/css/buttons.bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables/Buttons-1.2.4/css/buttons.dataTables.css') }}">

	@yield('head')
</head>
<body class="admin-body" style="margin-left: 10%;margin-right: 10%;">
	@include('admin.template.partials.nav')

	<section>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">@yield('title')</h3>
			</div>

			<div class="panel-body">
				@if (Session::has('flash_notification.message'))
				    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

				        {{ Session::get('flash_notification.message') }}
				    </div>
				@endif
				@yield('content')
			</div>
		</div>

	</section>

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

<script src="{{ asset('plugins/jquery/js/jquery-2.1.4.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('plugins/datatables/DataTables-1.10.13/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/datatables/DataTables-1.10.13/js/jquery.dataTables.js') }}" ></script>
<script src="{{ asset('plugins/datatables/Buttons-1.2.4/js/dataTables.buttons.js') }}"></script>
<script src="{{ asset('plugins/dataTables/Buttons-1.2.4/js/buttons.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/datatables/Buttons-1.2.4/js/buttons.colVis.js') }}"></script>
@yield('script')

	
</body>
</html>