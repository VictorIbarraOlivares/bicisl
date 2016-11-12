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

</body>
</html>