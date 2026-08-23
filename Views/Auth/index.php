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

        <div class="y2k-window">
                <div class="y2k-window-header">
                        <span>MailSYS - Login.exe</span>
                        <div class="y2k-window-controls">
                                <span></span>
                                <span></span>
                                <span></span>
                        </div>
                </div>

                <div class="y2k-window-body">
                        <h1>Login</h1>

                        <?php if (isset($error)): ?>
                                <div class="y2k-alert-error">
                                        <p style="margin: 0;"><?php echo $error; ?></p>
                                </div>
                        <?php endif; ?>

                        <form action="index.php?action=login" method="POST">
                                <label>Correo Electrónico:</label>
                                <input type="email" name="email" placeholder="usuario@mailsys.com" required>

                                <label>Contraseña:</label>
                                <input type="password" name="password" required>

                                <button type="submit">Siguiente &gt;&gt;</button>
                        </form>

                        <div style="margin-top: 20px; text-align: center;">
                                <p style="font-size: 13px; margin-bottom: 8px;">
                                        ¿No tienes cuenta? <a href="index.php?action=register">Crea una</a>
                                </p>
                                <a href="#" style="font-size: 12px;">¿No recuerdas tu contraseña?</a>
                        </div>
                </div>
        </div>

</body>
</html>