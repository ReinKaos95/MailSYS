<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>

<?php require_once ROOT_PATH . 'Views/Layouts/main.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register - <?php echo Title; ?></title>
	<!-- Hoja de estilos Y2K Metalizado -->
	<link rel="stylesheet" href="public/css/y2k.css">
</head>
<body>

<div class="card-auth">
    <h1>Crear Cuenta</h1>
    <p style="text-align: center; color: var(--text-muted); font-size: 14px; margin-bottom: 20px;">Únete a la plataforma MailSYS</p>

    <?php if (!empty($errors)): ?>
        <div class="alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?action=storeUser" method="POST">
        <label>Correo Electrónico</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" placeholder="tu@empresa.com" required>

        <label>Contraseña</label>
        <input type="password" name="password" placeholder="••••••••" required>

        <button type="submit">Registrarme</button>
    </form>

    <div style="margin-top: 24px; text-align: center; font-size: 14px;">
        <p style="color: var(--text-muted);">
            ¿Ya tienes cuenta? <a href="index.php" style="color: var(--primary); font-weight: 600;">Inicia sesión</a>
        </p>
    </div>
</div>

</body>
</html>