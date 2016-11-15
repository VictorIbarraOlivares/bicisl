<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', 'Default') | Panel de Administración</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
</head>
<body>
	@include('admin.template.partials.nav')

	<section>
		@include('flash::message')
		@yield('content')
	</section>

	<footer class="admin-footer">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="collapse navbar-collapse">
					<p class="navbar-text"> Todos los derechos reservados &copy {{ date('Y') }}</p>
					<p class="navbar-text navbar-right"><b>Ing.Sw.2° Semestre</b></p>
				</div>
				
			</div>
		</nav>
		
	</footer>

	<script src="{{ asset('plugins/jquery/js/jquery-2.1.4.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>