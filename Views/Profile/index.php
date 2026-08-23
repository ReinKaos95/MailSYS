<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>
<?php require_once ROOT_PATH . 'Views/Layouts/main.php'; ?>
<body>

<div class="y2k-window" style="max-width: 550px;">
	<div class="y2k-window-header">
		<span>MailSYS - User_Profile.exe</span>
		<div class="y2k-window-controls">
			<span></span><span></span><span></span>
		</div>
	</div>

	<div class="y2k-window-body">
		<h1>Mi Perfil</h1>

		<div style="background: rgba(3, 15, 38, 0.8); border: 1px solid rgba(0,240,255,0.4); border-radius: 15px; padding: 15px; margin-bottom: 20px;">
			<p><strong>Correo:</strong> <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'No disponible'); ?></p>
			<p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($user['nombre'] ?? $_SESSION['user_name'] ?? 'Sin asignar'); ?></p>
		</div>

		<div style="display: flex; gap: 10px;">
			<a href="index.php?action=config" style="text-align: center; width: 100%;"><button type="button">Editar Datos</button></a>
			<a href="index.php?action=dashboard" style="text-align: center; width: 100%;"><button type="button">Volver</button></a>
		</div>
	</div>
</div>

</body>
</html>