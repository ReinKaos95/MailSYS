
<body>
<h1>MailSYS</h1>
<header class="y2k-navbar">
    <h1 style="margin:0; font-size: 18px;">MailSYS v1.0</h1>
    <ul>
        <li>📅 Calendario</li>
        <li>🔔 Notificaciones</li>
        <li>⚙️ Configuración</li>
        <li class="y2k-user-badge">
            <span>👤 <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'Usuario'); ?></span>
        </li>
        <li>
            <!-- Botón para cerrar sesión -->
            <a href="index.php?action=logout" style="color: #ff3366; text-decoration: none; font-weight: bold;">
                🚪 Salir
            </a>
        </li>
    </ul>
</header>