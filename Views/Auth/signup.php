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
	<!-- Mostrar errores de validación si existen -->
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
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