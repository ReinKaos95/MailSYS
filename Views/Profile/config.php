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
                <form action="index.php?action=updateProfile" method="POST">
                    <label>Nombre de Usuario</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($user['nombre'] ?? ''); ?>" placeholder="Ingresa tu nombre completo">

                    <label>Correo Electrónico (No editable)</label>
                    <input type="email" value="<?php echo htmlspecialchars($user['correo'] ?? ''); ?>" disabled style="background: var(--background); cursor: not-allowed;">

                    <label>Nueva Contraseña (Opcional)</label>
                    <input type="password" name="password" placeholder="••••••••">

                    <button type="submit">Guardar Cambios</button>
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
            <?php endif; ?>

        </main>
    </div>
</div>

<script type="text/javascript" src="public/js/sidebar.js"></script>
</body>
</html>