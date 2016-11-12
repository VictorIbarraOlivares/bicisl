<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
</head>
<body>
<h2>Usuarios</h2>
	<ul>
		@foreach ($users as $user)
		<li>
			{{ $user->user }}
		</li>
		@endforeach
	</ul>
	<form method="POST">
	{{ csrf_field() }}
	<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
	<textarea></textarea>
	<button type="submit">Crear Funcionario</button>
		
	</form>

</body>
</html>