	// Alternar visibilidad del modal
	function toggleCalendarModal(show) {
		const modal = document.getElementById('calendarModal');
		modal.classList.toggle('active', show);
		if (show) {
			const fechaHoy = document.getElementById('agendaFecha').value;
			cargarNotasFecha(fechaHoy);
		}
	}

	// Mostrar u ocultar el formulario de creación
	function mostrarFormNota(show) {
		document.getElementById('formCrearNota').style.display = show ? 'block' : 'none';
		document.getElementById('btnAbrirForm').style.display = show ? 'none' : 'block';
		document.getElementById('formNotaFecha').value = document.getElementById('agendaFecha').value;
	}

	// Cargar notas mediante fetch/AJAX al cambiar fecha
function cargarNotasFecha(fecha) {
    document.getElementById('formNotaFecha').value = fecha;
    const ul = document.getElementById('listaNotas');
    ul.innerHTML = '<li>Cargando notas...</li>';

    fetch(`index.php?action=getNotes&fecha=${fecha}`)
        .then(response => {
            if (!response.ok) throw new Error('Error en la respuesta del servidor');
            return response.json();
        })
        .then(data => {
            ul.innerHTML = '';
            if (!Array.isArray(data) || data.length === 0) {
                ul.innerHTML = '<li style="color: #a0c0d0;">No hay notas para este día.</li>';
            } else {
                data.forEach(nota => {
                    const horaTxt = nota.hora ? `[${nota.hora.substring(0,5)}] ` : '';
                    const descTxt = nota.descripcion ? ` - <small>${nota.descripcion}</small>` : '';
                    ul.innerHTML += `<li><strong>${horaTxt}${nota.titulo}</strong>${descTxt}</li>`;
                });
            }
        })
        .catch(error => {
            console.error('Error Agenda:', error);
            ul.innerHTML = '<li style="color: #ff99bb;">Error al cargar las notas.</li>';
        });
}