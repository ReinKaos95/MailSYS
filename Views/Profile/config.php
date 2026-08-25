<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>
<?php include 'Views/Layouts/main.php'; ?>

<?php if (($_SESSION['user_role'] ?? '') === 'superadmin'): ?>

<?php endif; ?>
<!-- Estilo forzado para controlar visibilidad de paneles -->
<style>
    .tab-content {
        display: none !important;
    }
    .tab-content.active {
        display: block !important;
    }
</style>

<div class="y2k-app-layout" style="max-width: 950px;">
    
    <!-- Header superior -->
    <header class="y2k-navbar">
        <h1 style="margin:0; font-size: 18px;">Settings.exe - Panel de Control</h1>
        <a href="index.php?action=dashboard" style="color: var(--cyan-glow); font-size: 13px;">&lt;&lt; Volver a la Bandeja</a>
    </header>

    <!-- Layout de 2 Paneles (Estilo MailSYS) -->
    <div class="y2k-main-container">
        
        <!-- PANEL IZQUIERDO: Menú de Pestañas -->
        <aside class="y2k-sidebar" style="width: 250px;">
            <ul>
                <li class="tab-btn active" onclick="switchTab('tab-cuenta', this)">👤 Mi Cuenta</li>
                
                <?php if (($_SESSION['user_role'] ?? '') === 'superadmin'): ?>
                    <li class="tab-btn" onclick="switchTab('tab-usuarios', this)">🛠️ Gestión de Usuarios</li>
                    <li class="tab-btn" onclick="switchTab('tab-crear', this)">➕ Crear Nuevo Usuario</li>
                <?php endif; ?>
            </ul>
        </aside>

        <!-- PANEL DERECHO: Área de Contenido Dinámico -->
        <main class="y2k-content-area">
            
            <!-- Mensajes de Notificación -->
            <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                <div style="background: rgba(0, 80, 40, 0.6); border: 1px solid #00ffaa; border-radius: 12px; padding: 10px; margin-bottom: 15px; color: #aaffdd; font-size: 13px;">
                    ✅ Cambios guardados con éxito.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'created'): ?>
                <div style="background: rgba(0, 80, 40, 0.6); border: 1px solid #00ffaa; border-radius: 12px; padding: 10px; margin-bottom: 15px; color: #aaffdd; font-size: 13px;">
                    ✅ Nuevo usuario registrado correctamente.
                </div>
            <?php endif; ?>

            <!-- PANEL 1: EDITAR MI CUENTA -->
            <div id="tab-cuenta" class="tab-content active">
                <div class="y2k-window-header" style="margin: -20px -20px 20px -20px;">
                    <span>Perfil de Usuario</span>
                </div>
                <form action="index.php?action=updateProfile" method="POST">
                    <label>Nombre de Usuario:</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($user['nombre'] ?? ''); ?>" placeholder="Tu nombre...">

                    <label>Correo Electrónico (No editable):</label>
                    <input type="email" value="<?php echo htmlspecialchars($user['correo'] ?? ''); ?>" disabled style="opacity: 0.6; cursor: not-allowed;">

                    <label>Nueva Contraseña (dejar en blanco si no deseas cambiarla):</label>
                    <input type="password" name="password" placeholder="••••••••">

                    <button type="submit">Actualizar Mi Cuenta &gt;&gt;</button>
                </form>
            </div>

            <!-- PANEL 2: GESTIÓN DE USUARIOS (Solo Superadmin) -->
            <?php if (($_SESSION['user_role'] ?? '') === 'superadmin'): ?>
            <div id="tab-usuarios" class="tab-content">
                <div class="y2k-window-header" style="margin: -20px -20px 20px -20px;">
                    <span>Usuarios Registrados</span>
                </div>
                <div style="background: rgba(3, 15, 38, 0.8); border: 1px solid rgba(0,240,255,0.4); border-radius: 15px; padding: 10px; overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: left;">
                        <thead>
                            <tr style="border-bottom: 1px solid var(--cyan-glow); color: var(--cyan-glow);">
                                <th style="padding: 8px;">ID</th>
                                <th style="padding: 8px;">Correo</th>
                                <th style="padding: 8px;">Nombre</th>
                                <th style="padding: 8px;">Rol</th>
                                <th style="padding: 8px;">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($listaUsuarios) && is_array($listaUsuarios)): ?>
                                <?php foreach ($listaUsuarios as $u): ?>
                                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                                        <td style="padding: 8px;"><?php echo $u['id']; ?></td>
                                        <td style="padding: 8px;"><?php echo htmlspecialchars($u['correo']); ?></td>
                                        <td style="padding: 8px;"><?php echo htmlspecialchars($u['nombre'] ?? 'Sin asignar'); ?></td>
                                        <td style="padding: 8px;">
                                            <span style="color: <?php echo $u['rol_nombre'] === 'superadmin' ? '#00ffaa' : '#ffffff'; ?>;">
                                                <?php echo strtoupper($u['rol_nombre']); ?>
                                            </span>
                                        </td>
                                        <td style="padding: 8px;">
                                            <?php if ($u['rol_nombre'] !== 'superadmin'): ?>
                                                <button style="margin: 0; padding: 3px 8px; font-size: 10px; background: #660022;">Suspender</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 15px; color: #a0c0d0;">No hay usuarios para mostrar o no tienes permisos suficientes.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PANEL 3: CREAR NUEVO USUARIO (Solo Superadmin) -->
            <div id="tab-crear" class="tab-content">
                <div class="y2k-window-header" style="margin: -20px -20px 20px -20px;">
                    <span>Alta de Nuevo Usuario</span>
                </div>
                <form action="index.php?action=storeUserByAdmin" method="POST">
                    <label>Nombre Completo / Username:</label>
                    <input type="text" name="nombre" placeholder="Ej: Carlos Pérez" required>

                    <label>Correo Electrónico:</label>
                    <input type="email" name="correo" placeholder="nuevo@mailsys.com" required>

                    <label>Contraseña Inicial:</label>
                    <input type="password" name="password" required>

                    <label>Rol de Usuario:</label>
                    <select name="rol_id" style="width: 100%; padding: 10px; background: rgba(3, 15, 38, 0.9); color: #fff; border: 1px solid rgba(0,240,255,0.4); border-radius: 25px; outline: none; margin-bottom: 15px;">
                        <option value="2">Usuario Regular</option>
                        <option value="1">Superadmin</option>
                    </select>

                    <button type="submit" style="background: linear-gradient(180deg, #ffffff 0%, #a1caff 30%, #154a7a 70%, #002244 100%);">
                        ➕ Registrar Usuario en Sistema
                    </button>
                </form>
            </div>
            <?php endif; ?>

        </main>
    </div>
</div>

<script type="text/javascript" src="public/js/sidebar.js"></script>