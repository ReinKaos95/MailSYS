<?php
require_once ROOT_PATH . 'App/Config/define.php'; 
require_once ROOT_PATH . 'App/Config/db.php'; 
require_once ROOT_PATH . 'Views/Layouts/main.php'; 

$conn = new connection();
$conn->connect()?>

<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - <?php echo Title; ?></title>
        <!-- Hoja de estilos Y2K Metalizado -->
        <link rel="stylesheet" href="public/css/y2k.css">
</head>
<body>

<div class="card-auth">
    <h1>Iniciar Sesión</h1>
    <p style="text-align: center; color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">Ingresa a tu cuenta corporativa de MailSYS</p>

    <?php if (isset($error)): ?>
        <div class="alert-error">
            <p style="margin: 0;"><?php echo $error; ?></p>
        </div>
    <?php endif; ?>

    <form action="index.php?action=login" method="POST">
        <label>Correo Electrónico</label>
        <input type="email" name="email" placeholder="usuario@mailsys.com" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button type="submit">Ingresar</button>
    </form>

    <div style="margin-top: 24px; text-align: center; font-size: 14px;">
        <p style="color: var(--text-muted);">
            ¿No tienes cuenta? <a href="index.php?action=register" style="color: var(--primary); font-weight: 600;">Crea una aquí</a>
        </p>
    </div>
</div>

</body>
</html>