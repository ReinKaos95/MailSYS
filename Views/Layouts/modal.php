<!-- Modal Y2K del Calendario Agenda -->
<div id="calendarModal" class="y2k-modal">
	<div class="y2k-window" style="width: 90%; max-width: 500px; margin: 0;">
		<div class="y2k-window-header">
			<span>Agenda_CyberCalendar.exe</span>
			<div class="y2k-window-controls">
				<span onclick="toggleCalendarModal(false)">X</span>
			</div>
		</div>
		<div class="y2k-window-body">
			<h2 style="font-size: 18px; text-align: center;">📅 Agenda Personal</h2>
			
			<!-- Selector de Fecha (Día mínimo: HOY) -->
			<div style="margin-bottom: 15px; text-align: center;">
				<input type="date" id="agendaFecha" 
				       value="<?php echo date('Y-m-d'); ?>" 
				       min="<?php echo date('Y-m-d'); ?>" 
				       onchange="cargarNotasFecha(this.value)"
				       style="padding: 6px; border-radius: 15px; background: rgba(3, 15, 38, 0.9); color: #fff; border: 1px solid var(--cyan-glow); outline: none;">
			</div>

			<!-- Lista de Notas del Día -->
			<div style="background: rgba(3, 15, 38, 0.8); border: 1px solid rgba(0,240,255,0.3); border-radius: 12px; padding: 10px; max-height: 160px; overflow-y: auto; margin-bottom: 15px;">
				<p style="font-size: 12px; color: var(--cyan-glow); margin: 0 0 5px 0;"><strong>Eventos / Notas del Día:</strong></p>
				<ul id="listaNotas" style="padding-left: 20px; font-size: 13px; margin: 0; color: #fff;">
					<li>Cargando notas...</li>
				</ul>
			</div>

			<!-- Formulario Oculto para Crear Nueva Nota -->
			<div id="formCrearNota" style="display: none; background: rgba(0, 240, 255, 0.05); padding: 10px; border-radius: 12px; border: 1px solid var(--cyan-glow); margin-bottom: 15px;">
				<form action="index.php?action=storeNote" method="POST">
					<input type="hidden" name="fecha" id="formNotaFecha" value="<?php echo date('Y-m-d'); ?>">
					
					<label style="font-size: 11px;">Título de la Nota:</label>
					<input type="text" name="titulo" placeholder="Ej: Reunión MailSys" required style="margin-bottom: 8px;">

					<label style="font-size: 11px;">Hora (Opcional):</label>
					<input type="time" name="hora" style="margin-bottom: 8px; width: 100%; padding: 6px; border-radius: 15px; background: rgba(3, 15, 38, 0.9); color: #fff; border: 1px solid rgba(0,240,255,0.4);">

					<label style="font-size: 11px;">Descripción:</label>
					<input type="text" name="descripcion" placeholder="Detalles de la nota..." style="margin-bottom: 10px;">

					<div style="display: flex; gap: 8px;">
						<button type="submit" style="margin-top:0;">Guardar Nota</button>
						<button type="button" onclick="mostrarFormNota(false)" style="margin-top:0; background: #660022;">Cancelar</button>
					</div>
				</form>
			</div>

			<div style="display: flex; gap: 10px;">
				<button type="button" id="btnAbrirForm" onclick="mostrarFormNota(true)">Crear nota</button>
				<button type="button" onclick="toggleCalendarModal(false)">Cerrar Agenda</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="public/js/modal.js"></script>