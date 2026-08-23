<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Main - <?php echo Title; ?></title>
	<link rel="stylesheet" href="public/css/main.css">
	<style>
		/* Estilos para el Modal Y2K Agenda */
		.y2k-modal {
			display: none;
			position: fixed;
			top: 0; left: 0;
			width: 100%; height: 100%;
			background: rgba(0, 5, 17, 0.75);
			backdrop-filter: blur(8px);
			z-index: 999;
			justify-content: center;
			align-items: center;
		}
		.y2k-modal.active { display: flex; }
	</style>
</head>
