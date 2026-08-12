<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>

<?php require_once ROOT_PATH . 'Views/Layouts/title.php'; ?>
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

	<div class="y2k-window">
		<div class="y2k-window-header">
			<span>MailSYS - Signup.exe</span>
			<div class="y2k-window-controls">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>

		<div class="y2k-window-body">
			<h1>Signup</h1>

			<!-- Mostrar errores de validación si existen -->
			<?php if (!empty($errors)): ?>
				<div class="y2k-alert-error">
					<ul style="margin: 0; padding-left: 20px;">
						<?php foreach ($errors as $error): ?>
							<li><?php echo $error; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

			<form action="index.php?action=storeUser" method="POST">
				<label>Correo</label>
				<input type="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>

				<label>Contraseña</label>
				<input type="password" name="password" required>

				<button type="submit">Registrarme &gt;&gt;</button>
			</form>

			<div style="margin-top: 20px; text-align: center;">
				<p style="font-size: 13px;">¿Ya tienes cuenta? <a href="index.php">Inicia sesión</a></p>
			</div>
		</div>
	</div>

</body>
</html>