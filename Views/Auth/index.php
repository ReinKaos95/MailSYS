<?php include '../../App/Config/define.php'; 
include '../../App/Config/db.php'; 

$conn = new connection();
$conn->connect()?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - <?php echo Title; ?></title>
</head>
<body>
	<h1>Login</h1>
	<div>
		<form action="" method="post">
			<label>Correo</label>
			<input type="text" name="">
			<br>
			<label>Contraseña</label>
			<input type="password" name="">
			<br>
			<p>no tienes cuenta? <a href="signup.php">Cree una</a></p>
			<br>
			<a href="#">No recuerda su contraseña?</a>
			<br>
			<button type="submit">Siguiente</button>
		</form>
	</div>
</body>
</html>