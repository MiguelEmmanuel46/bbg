<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			font-family: 'Verdana';
			font-size: 15px;
		}
		h1{
			font-size: 20px;
			font-weight: bold;
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<h1>Mensaje de  {{$name}}</h1>
	<p>Telefono: {{$telefono}}</p>
        <p>Email: {{$email}}</p>
        <p>Mensaje: </p>
        <p>{{$mensaje}}</p>
</body>
</html>