<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>
<?php include 'Views/Layouts/main.php'; ?>

<?php if (($_SESSION['user_role'] ?? '') === 'superadmin'): ?>

<?php endif; ?>
<div class="app-layout">
    
    <!-- Navbar Corporativa -->
    <header class="navbar">
        <h1>MailSYS | Panel de Configuración</h1>
        <a href="index.php?action=dashboard" style="color: var(--primary); text-decoration: none; font-size: 14px; font-weight: 500;">
            ← Volver a la Bandeja
        </a>
    </header>

    <!-- Layout de 2 Paneles -->
    <div class="main-container">
        
        <!-- Menú Lateral -->
        <aside class="sidebar">
            <ul>
                <li class="tab-btn active" onclick="switchTab('tab-cuenta', this)">👤 Mi Cuenta</li>
                
                <?php if (($_SESSION['user_role'] ?? '') === 'superadmin'): ?>
                    <li class="tab-btn" onclick="switchTab('tab-usuarios', this)">🛠️ Gestión de Usuarios</li>
                    <li class="tab-btn" onclick="switchTab('tab-crear', this)">➕ Crear Nuevo Usuario</li>
                    <li class="tab-btn" onclick="switchTab('tab-devlog', this)">📋 DevLog / Versiones</li>
                <?php endif; ?>
            </ul>
        </aside>

        <!-- Área de Contenido -->
        <main class="content-area">
            
            <!-- Notificaciones -->
            <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                <div class="alert-success">
                    ✅ Cambios guardados con éxito.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'created'): ?>
                <div class="alert-success">
                    ✅ Nuevo usuario registrado correctamente.
                </div>
            <?php endif; ?>

<!-- PANEL 1: EDITAR MI CUENTA -->
<div id="tab-cuenta" class="tab-content active">
    <div class="window-header">
        <h2>Perfil de Usuario</h2>
    </div>

    <!-- Alertas de error/éxito -->
    <?php if (isset($_GET['error'])): ?>
        <div class="alert-error" style="background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 6px; margin-bottom: 15px;">
            <?php 
                switch ($_GET['error']) {
                    case 'cedula_invalida': echo 'El formato de la cédula no es válido (ej: V-12345678).'; break;
                    case 'cedula_duplicada': echo 'Esta cédula ya se encuentra registrada por otro usuario.'; break;
                    case 'menor_edad': echo 'Debes ser mayor de 18 años.'; break;
                    case 'foto_formato': echo 'Solo se permiten imágenes JPG, PNG o WEBP.'; break;
                    case 'foto_tamano': echo 'La imagen debe pesar menos de 2 MB.'; break;
                    default: echo 'Ocurrió un error al guardar los cambios.'; break;
                }
            ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=updateProfile" method="POST" enctype="multipart/form-data">
        
        <!-- Previsualización de Foto -->
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
            <img src="<?php echo !empty($user['foto']) ? htmlspecialchars($user['foto']) : 'public/images/default-avatar.png'; ?>" 
                 alt="Foto de Perfil" 
                 style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
            <div>
                <label style="margin: 0;">Foto de Perfil</label>
                <input type="file" name="foto" accept="image/png, image/jpeg, image/webp" style="margin-top: 5px;">
            </div>
        </div>

        <label>Nombre de Usuario</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($user['nombre'] ?? ''); ?>" placeholder="Ingresa tu nombre completo">

        <label>Cédula de Identidad</label>
        <input type="text" name="cedula" value="<?php echo htmlspecialchars($user['cedula'] ?? ''); ?>" placeholder="Ej: V-12345678">

        <label>Sección / Área de Trabajo</label>
        <select name="seccion_trabajo">
            <option value="">-- Seleccionar Área --</option>
            <option value="Administración" <?php echo ($user['seccion_trabajo'] ?? '') === 'Administración' ? 'selected' : ''; ?>>Administración</option>
            <option value="Sistemas / TI" <?php echo ($user['seccion_trabajo'] ?? '') === 'Sistemas / TI' ? 'selected' : ''; ?>>Sistemas / TI</option>
            <option value="Recursos Humanos" <?php echo ($user['seccion_trabajo'] ?? '') === 'Recursos Humanos' ? 'selected' : ''; ?>>Recursos Humanos</option>
            <option value="Ventas" <?php echo ($user['seccion_trabajo'] ?? '') === 'Ventas' ? 'selected' : ''; ?>>Ventas</option>
            <option value="Operaciones" <?php echo ($user['seccion_trabajo'] ?? '') === 'Operaciones' ? 'selected' : ''; ?>>Operaciones</option>
        </select>

        <label>Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" value="<?php echo htmlspecialchars($user['fecha_nacimiento'] ?? ''); ?>">

        <label>Correo Electrónico (No editable)</label>
        <input type="email" value="<?php echo htmlspecialchars($user['correo'] ?? ''); ?>" disabled style="background: var(--background); cursor: not-allowed;">

        <label>Nueva Contraseña (Opcional)</label>
        <input type="password" name="password" placeholder="Dejar en blanco para mantener la actual">

        <button type="submit" style="margin-top: 15px;">Guardar Cambios</button>
    </form>
</div>

            <!-- PANEL 2: GESTIÓN DE USUARIOS (Superadmin) -->
            <?php if (($_SESSION['user_role'] ?? '') === 'superadmin'): ?>
            <div id="tab-usuarios" class="tab-content">
                <div class="window-header">
                    <h2>Usuarios Registrados</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Correo</th>
                            <th>Nombre</th>
                            <th>Rol</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($listaUsuarios) && is_array($listaUsuarios)): ?>
                            <?php foreach ($listaUsuarios as $u): ?>
                                <tr>
                                    <td><?php echo $u['id']; ?></td>
                                    <td><?php echo htmlspecialchars($u['correo']); ?></td>
                                    <td><?php echo htmlspecialchars($u['nombre'] ?? 'Sin asignar'); ?></td>
                                    <td>
                                        <span class="user-badge" style="<?php echo $u['rol_nombre'] === 'superadmin' ? 'background: #fef3c7; color: #92400e;' : ''; ?>">
                                            <?php echo strtoupper($u['rol_nombre']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($u['rol_nombre'] !== 'superadmin'): ?>
                                            <button style="margin: 0; padding: 4px 8px; font-size: 12px; background: #dc2626;">Suspender</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: var(--text-muted);">No hay usuarios registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PANEL 3: CREAR USUARIO (Superadmin) -->
            <div id="tab-crear" class="tab-content">
                <div class="window-header">
                    <h2>Alta de Nuevo Usuario</h2>
                </div>
                <form action="index.php?action=storeUserByAdmin" method="POST">
                    <label>Nombre Completo / Username</label>
                    <input type="text" name="nombre" placeholder="Ej: Carlos Pérez" required>

                    <label>Correo Electrónico</label>
                    <input type="email" name="correo" placeholder="usuario@empresa.com" required>

                    <label>Contraseña Inicial</label>
                    <input type="password" name="password" required>

                    <label>Rol de Usuario</label>
                    <select name="rol_id">
                        <option value="2">Usuario Regular</option>
                        <option value="1">Superadmin</option>
                    </select>

                    <button type="submit">Registrar Usuario</button>
                </form>
            </div>

<!-- PANEL 4: DEVLOG (Superadmin) -->
<div id="tab-devlog" class="tab-content">
    <div class="window-header">
        <h2>Registro de Versiones (DevLog)</h2>
    </div>

    <!-- Formulario para publicar versión -->
    <form action="index.php?action=storeDevLog" method="POST" style="background: var(--background); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 16px; margin-bottom: 24px;">
        <h3 style="font-size: 15px; margin-bottom: 12px;">Publicar Nueva Versión</h3>
        
        <div style="display: flex; gap: 12px;">
            <div style="width: 30%;">
                <label>Versión (ej: v1.1.0)</label>
                <input type="text" name="version" placeholder="v1.0.0" required>
            </div>
            <div style="width: 70%;">
                <label>Título del Cambio</label>
                <input type="text" name="titulo" placeholder="Migración a UI Corporativa" required>
            </div>
        </div>

        <label>Tipo de Actualización</label>
        <select name="tipo">
            <option value="feature">✨ Característica Nueva (Feature)</option>
            <option value="fix">🐛 Corrección de Errores (Bug Fix)</option>
            <option value="update">🚀 Mejora General (Update)</option>
        </select>

        <label>Detalles / Registro de Cambios</label>
        <textarea name="descripcion" rows="3" required style="width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: var(--radius-sm); outline: none; font-size: 14px; resize: vertical;"></textarea>

        <button type="submit" style="margin-top: 12px;">Guardar Versión</button>
    </form>

    <!-- Historial de Versiones -->
    <div class="window-header">
        <h3 style="font-size: 15px;">Historial del Sistema</h3>
    </div>

    <?php if (!empty($devlogs) && is_array($devlogs)): ?>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <?php foreach ($devlogs as $log): ?>
                <div style="border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 14px; background: var(--surface);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <div>
                            <span class="user-badge" style="font-size: 12px; margin-right: 8px;"><?php echo htmlspecialchars($log['version']); ?></span>
                            <strong><?php echo htmlspecialchars($log['titulo']); ?></strong>
                        </div>
                        <span style="font-size: 12px; color: var(--text-muted);"><?php echo htmlspecialchars(substr($log['created_at'], 0, 10)); ?></span>
                    </div>
                    <p style="font-size: 13px; color: var(--text-muted); white-space: pre-line; margin-top: 4px;"><?php echo htmlspecialchars($log['descripcion']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p style="color: var(--text-muted); font-size: 14px;">No hay registros de versiones cargados.</p>
    <?php endif; ?>
</div>
            
            <?php endif; ?>

        </main>
    </div>
</div>

<script type="text/javascript" src="public/js/sidebar.js"></script>
</body>
</html>