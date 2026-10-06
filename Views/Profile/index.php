<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>
<?php require_once ROOT_PATH . 'Views/Layouts/main.php'; ?>
<body>
<div class="card-auth" style="max-width: 950px; width: 95%; margin: 30px auto; padding: 24px;">
    
    <!-- Header del Perfil -->
    <div class="window-header" style="margin-bottom: 20px;">
        <h2>Mi Perfil</h2>
    </div>

    <!-- Layout de 2 Columnas estilo Maqueta -->
    <div style="display: flex; gap: 24px; align-items: stretch; flex-wrap: wrap;">
        
        <!-- PANEL IZQUIERDO: Tarjeta de Perfil -->
        <aside style="flex: 1; min-width: 260px; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 24px; display: flex; flex-direction: column; align-items: center; justify-content: space-between; text-align: center;">
            
            <div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                <!-- Foto de Perfil Circular -->
                <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; border: 3px solid var(--primary); margin-bottom: 16px; background: var(--background);">
                    <img src="<?php echo !empty($user['foto']) ? htmlspecialchars($user['foto']) : 'public/images/default-avatar.png'; ?>" 
                         alt="Foto de perfil" 
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>

                <!-- Nombre -->
                <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 6px; color: var(--text-main);">
                    <?php echo htmlspecialchars($user['nombre'] ?? $_SESSION['user_name'] ?? 'Usuario'); ?>
                </h3>

                <!-- Cargo / Sección -->
                <p style="font-size: 14px; color: var(--primary); font-weight: 600; margin-bottom: 4px;">
                    <?php echo htmlspecialchars($user['seccion_trabajo'] ?? 'Sin cargo asignado'); ?>
                </p>

                <!-- Fecha de Nacimiento -->
                <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 12px;">
                    📅 <?php echo !empty($user['fecha_nacimiento']) ? htmlspecialchars($user['fecha_nacimiento']) : 'Fecha de nac. no especificada'; ?>
                </p>

                <!-- Cédula y Correo opcionales -->
                <?php if (!empty($user['cedula'])): ?>
                    <span class="user-badge" style="font-size: 12px; margin-bottom: 8px;">
                        🪪 <?php echo htmlspecialchars($user['cedula']); ?>
                    </span>
                <?php endif; ?>
                
                <p style="font-size: 12px; color: var(--text-muted); word-break: break-all;">
                    ✉️ <?php echo htmlspecialchars($_SESSION['user_email'] ?? $user['correo'] ?? ''); ?>
                </p>
            </div>

            <!-- Botón Editar e Ir al Dashboard -->
            <div style="width: 100%; margin-top: 24px; display: flex; flex-direction: column; gap: 8px;">
                <a href="index.php?action=config" style="width: 100%;">
                    <button type="button" style="width: 100%;">Editar Perfil</button>
                </a>
                <a href="index.php?action=dashboard" style="width: 100%;">
                    <button type="button" style="width: 100%; background: var(--background); color: var(--text-main); border: 1px solid var(--border);">Volver</button>
                </a>
            </div>

        </aside>

        <!-- PANEL DERECHO: Agenda / Compromisos -->
        <main style="flex: 2; min-width: 320px; background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 20px; display: flex; flex-direction: column;">
            
            <div class="window-header" style="margin-bottom: 16px;">
                <h2>Agenda / Compromisos</h2>
            </div>

            <div style="flex: 1; max-height: 380px; overflow-y: auto; border: 1px solid var(--border); border-radius: var(--radius-sm);">
                <table style="width: 100%; border-collapse: collapse;">
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
                                <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 24px;">
                                    No tienes notas o compromisos registrados en tu agenda.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </main>

    </div>
</div>
</body>
</html>