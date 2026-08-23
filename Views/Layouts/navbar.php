	<!-- Navbar interactiva -->
	<header class="y2k-navbar">
		<h1 style="margin:0; font-size: 18px;">MailSYS v1.0</h1>
		<ul>
			<!-- Modal de Agenda -->
			<li onclick="toggleCalendarModal(true)">📅 Agenda / Calendario</li>
			
			<!-- Enlace a Configuración -->
			<li><a href="index.php?action=config" style="color: inherit; text-decoration: none;">⚙️ Configuración</a></li>
			
			<!-- Enlace a Perfil -->
			<li class="y2k-user-badge">
				<a href="index.php?action=profile" style="color: inherit; text-decoration: none; display: flex; align-items: center; gap: 5px;">
					<span>👤 <?php echo htmlspecialchars($_SESSION['user_name'] ?? $_SESSION['user_email'] ?? 'Usuario'); ?></span>
				</a>
			</li>
			<li>
				<a href="index.php?action=logout" style="color: #ff3366; text-decoration: none; font-weight: bold;">🚪 Salir</a>
			</li>
		</ul>
	</header>