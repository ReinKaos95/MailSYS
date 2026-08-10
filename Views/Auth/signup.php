<?php require_once 'App/Config/define.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register - <?php echo Title; ?></title>
</head>
<body>
	<h1>Signup</h1>
		<div>
        <form action="index.php?action=storeUser" method="POST">
            <label>Correo</label>
            <input type="email" name="email" required>
            <br>
            <label>Contraseña</label>
            <input type="password" name="password" required>
            <br>
            <p>¿Ya tienes cuenta? <a href="index.php">Inicia sesión</a></p>
            <br>
            <button type="submit">Registrarme</button>
        </form>
    </div>
</body>
</html>