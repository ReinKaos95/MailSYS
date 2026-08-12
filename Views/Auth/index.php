<?php
require_once ROOT_PATH . 'App/Config/define.php'; 
require_once ROOT_PATH . 'App/Config/db.php'; 
require_once ROOT_PATH . 'Views/Layouts/title.php'; 

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

<?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

<div>
        <form action="index.php?action=login" method="POST">
            <label>Correo</label>
            <input type="email" name="email" required>
            <br>
            <label>Contraseña</label>
            <input type="password" name="password" required>
            <br>
            <p>¿No tienes cuenta? <a href="index.php?action=register">Crea una</a></p>
            <br>
            <a href="#">¿No recuerdas tu contraseña?</a>
            <br>
            <button type="submit">Siguiente</button>
        </form>
    </div>
</body>
</html>