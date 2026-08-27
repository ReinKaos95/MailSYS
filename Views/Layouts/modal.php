<!-- Modal de la Agenda -->
<div id="calendarModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 999; justify-content: center; align-items: center;">
    <div class="content-area" style="width: 90%; max-width: 500px; background: var(--surface);">
        
        <div class="window-header" style="display: flex; justify-content: space-between; align-items: center;">
            <h2>📅 Agenda Personal</h2>
            <span onclick="toggleCalendarModal(false)" style="cursor: pointer; font-size: 18px; color: var(--text-muted); font-weight: bold;">✕</span>
        </div>

        <div style="margin-bottom: 16px; text-align: center;">
            <input type="date" id="agendaFecha" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" onchange="cargarNotasFecha(this.value)">
        </div>

        <div style="background: var(--background); border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 12px; max-height: 160px; overflow-y: auto; margin-bottom: 16px;">
            <p style="font-size: 12px; color: var(--text-muted); font-weight: 600; margin-bottom: 8px;">NOTAS DEL DÍA:</p>
            <ul id="listaNotas" style="padding-left: 20px; font-size: 14px;">
                <li>Cargando notas...</li>
            </ul>
        </div>

        <!-- Formulario para Nueva Nota -->
        <div id="formCrearNota" style="display: none; background: var(--background); padding: 16px; border-radius: var(--radius-sm); border: 1px solid var(--border); margin-bottom: 16px;">
            <form action="index.php?action=storeNote" method="POST">
                <input type="hidden" name="fecha" id="formNotaFecha" value="<?php echo date('Y-m-d'); ?>">
                
                <label>Título</label>
                <input type="text" name="titulo" placeholder="Ej: Reunión corporativa" required>

                <label>Hora</label>
                <input type="time" name="hora">

                <label>Descripción</label>
                <input type="text" name="descripcion" placeholder="Detalles de la nota...">

                <div style="display: flex; gap: 8px; margin-top: 12px;">
                    <button type="submit">Guardar Nota</button>
                    <button type="button" onclick="mostrarFormNota(false)" style="background: var(--background); color: var(--text-main); border: 1px solid var(--border);">Cancelar</button>
                </div>
            </form>
        </div>

        <div style="display: flex; gap: 12px;">
            <button type="button" id="btnAbrirForm" onclick="mostrarFormNota(true)">Crear nota</button>
            <button type="button" onclick="toggleCalendarModal(false)" style="background: var(--background); color: var(--text-main); border: 1px solid var(--border);">Cerrar</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="public/js/modal.js"></script>