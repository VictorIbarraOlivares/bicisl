
<!DOCTYPE html>
<html>
<head>
	<title>Detalle {{ $funcionario-> name }}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/general.css') }}" >
</head>
<body>
	<h1>Detalle Funcionario</h1>
	<br><br>
	<h3>Nombre </h3>
	{{ $funcionario-> name }}

	<h3>Rut </h3>
	{{ $funcionario-> rut }}

	<h3>Email </h3>
	{{ $funcionario-> email }}

	<h3>Password </h3>
	{{ $funcionario-> password }}

	<h4>Tipo </h4>
	{{ $funcionario-> type-> name }}
</body>
</html>