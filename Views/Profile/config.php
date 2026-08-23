
<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>
<?php include 'Views/Layouts/main.php'; ?>
<body>

    <div class="y2k-window" style="max-width: 500px;">
        <div class="y2k-window-header">
            <span>MailSYS - Settings.exe</span>
            <div class="y2k-window-controls">
                <span></span><span></span><span></span>
            </div>
        </div>

        <div class="y2k-window-body">
            <h1>Configuración</h1>

            <?php if (isset($success)): ?>
                <div style="background: rgba(0, 80, 40, 0.6); border: 1px solid #00ffaa; border-radius: 12px; padding: 10px; margin-bottom: 15px; color: #aaffdd; font-size: 13px;">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="y2k-alert-error">
                    <p style="margin:0;"><?php echo $error; ?></p>
                </div>
            <?php endif; ?>

            <form action="index.php?action=updateProfile" method="POST">
                <label>Nombre de Usuario:</label>
                <input type="text" name="nombre" placeholder="Nuevo Nombre" value="<?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?>">

                <label>Nueva Contraseña (dejar en blanco para conservar la actual):</label>
                <input type="password" name="password" placeholder="••••••••">

                <button type="submit">Guardar Cambios &gt;&gt;</button>
            </form>

            <div style="margin-top: 20px; text-align: center;">
                <a href="index.php?action=dashboard">&lt;&lt; Volver a la Bandeja de Entrada</a>
            </div>
        </div>
    </div>

</body>
</html>