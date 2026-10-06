<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>
<?php require_once ROOT_PATH . 'Views/Layouts/main.php'; ?>
<body>

<div class="card-auth" style="max-width: 600px;">
    <h1>Mi Perfil</h1>

    <div style="background: var(--background); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 16px; margin: 20px 0;">
        <p style="margin-bottom: 8px;"><strong>Correo:</strong> <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'No disponible'); ?></p>
        <p><strong>Nombre de Usuario:</strong> <?php echo htmlspecialchars($user['nombre'] ?? $_SESSION['user_name'] ?? 'Sin asignar'); ?></p>
    </div>

    <!-- Sección de Notas y Compromisos -->
    <div class="window-header" style="margin-top: 24px;">
        <h2>Notas y compromisos</h2>
    </div>

    <div style="max-height: 220px; overflow-y: auto; margin-bottom: 20px; border: 1px solid var(--border); border-radius: var(--radius-sm);">
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Título / Nota</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($notas) && is_array($notas)): ?>
                    <?php foreach ($notas as $nota): ?>
                        <tr>
                            <td style="font-weight: 500;"><?php echo htmlspecialchars($nota['fecha']); ?></td>
                            <td style="color: var(--text-muted); font-size: 13px;">
                                <?php echo !empty($nota['hora']) ? substr($nota['hora'], 0, 5) : '--:--'; ?>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($nota['titulo']); ?></strong>
                                <?php if (!empty($nota['descripcion'])): ?>
                                    <div style="font-size: 12px; color: var(--text-muted);">
                                        <?php echo htmlspecialchars($nota['descripcion']); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 16px;">
                            No tienes notas o compromisos registrados.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="display: flex; gap: 12px;">
        <a href="index.php?action=config" style="width: 100%;"><button type="button">Editar Datos</button></a>
        <a href="index.php?action=dashboard" style="width: 100%;"><button type="button" style="background: var(--background); color: var(--text-main); border: 1px solid var(--border);">Volver</button></a>
    </div>
</div>

</body>
</html>