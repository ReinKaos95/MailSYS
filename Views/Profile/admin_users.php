<?php require_once ROOT_PATH . 'App/Config/define.php'; ?>
<?php include 'Views/Layouts/main.php'; ?>


<div class="y2k-window" style="max-width: 800px;">
	<div class="y2k-window-header">
		<span>MailSYS - User_Management.exe [SUPERADMIN]</span>
		<div class="y2k-window-controls">
			<span></span><span></span><span></span>
		</div>
	</div>

	<div class="y2k-window-body">
		<h1>Control de Usuarios</h1>

		<div style="background: rgba(3, 15, 38, 0.8); border: 1px solid rgba(0,240,255,0.4); border-radius: 15px; padding: 15px; overflow-x: auto;">
			<table style="width: 100%; border-collapse: collapse; font-size: 13px; text-align: left;">
				<thead>
					<tr style="border-bottom: 1px solid var(--cyan-glow); color: var(--cyan-glow);">
						<th style="padding: 8px;">ID</th>
						<th style="padding: 8px;">Correo</th>
						<th style="padding: 8px;">Nombre</th>
						<th style="padding: 8px;">Rol</th>
						<th style="padding: 8px;">Acciones</th>
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
				                        <button style="margin: 0; padding: 4px 8px; font-size: 10px; background: #660022;">Suspender</button>
				                    <?php endif; ?>
				                </td>
				            </tr>
				        <?php endforeach; ?>
				    <?php else: ?>
				        <tr>
				            <td colspan="5" style="text-align: center; padding: 15px; color: #a0c0d0;">No hay usuarios registrados.</td>
				        </tr>
				    <?php endif; ?>
				</tbody>
			</table>
		</div>

		<div style="margin-top: 20px; text-align: center;">
			<a href="index.php?action=config">&lt;&lt; Volver a Configuración</a>
		</div>
	</div>
</div>
