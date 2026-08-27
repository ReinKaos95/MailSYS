<header class="navbar">
    <h1>MailSYS</h1>
    <ul>
        <li onclick="toggleCalendarModal(true)">📅 Agenda</li>
        <li><a href="index.php?action=config" style="color: inherit; text-decoration: none;">⚙️ Configuración</a></li>
        <li class="user-badge">
            <a href="index.php?action=profile" style="color: inherit; text-decoration: none;">
                👤 <?php echo htmlspecialchars($_SESSION['user_name'] ?? $_SESSION['user_email'] ?? 'Usuario'); ?>
            </a>
        </li>
        <li>
            <a href="index.php?action=logout" style="color: #dc2626; text-decoration: none; font-weight: 600;">Cerrar Sesión</a>
        </li>
    </ul>
</header>