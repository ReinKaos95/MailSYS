<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>
<?php require_once ROOT_PATH . 'Views/Layouts/main.php'; ?>
<body>

<div class="card-auth" style="max-width: 500px;">
    <h1>Mi Perfil</h1>

    <div style="background: var(--background); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 16px; margin: 20px 0;">
        <p style="margin-bottom: 8px;"><strong>Correo:</strong> <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'No disponible'); ?></p>
        <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($user['nombre'] ?? $_SESSION['user_name'] ?? 'Sin asignar'); ?></p>
    </div>

    <div style="display: flex; gap: 12px;">
        <a href="index.php?action=config" style="width: 100%;"><button type="button">Editar Datos</button></a>
        <a href="index.php?action=dashboard" style="width: 100%;"><button type="button" style="background: var(--background); color: var(--text-main); border: 1px solid var(--border);">Volver</button></a>
    </div>
</div>

</body>
</html>