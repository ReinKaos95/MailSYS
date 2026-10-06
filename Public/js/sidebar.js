// public/js/sidebar.js

function switchTab(tabId, element) {
    // 1. Ocultar todas las pestañas
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.style.display = 'none';
        tab.classList.remove('active');
    });

    // 2. Desmarcar todos los botones del menú lateral
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.style.background = '';
        btn.style.color = '';
    });

    // 3. Mostrar el panel activo
    const targetTab = document.getElementById(tabId);
    if (targetTab) {
        targetTab.style.display = 'block';
        targetTab.classList.add('active');
    }

    // 4. Resaltar el botón presionado
    if (element) {
        element.classList.add('active');
        element.style.background = 'linear-gradient(90deg, var(--cyan-glow, #00f0ff), #0055aa)';
        element.style.color = '#ffffff';
    }
}

// Ejecutar automáticamente al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('tab');

    if (activeTab === 'usuarios') {
        const btn = document.querySelectorAll('.tab-btn')[1];
        switchTab('tab-usuarios', btn);
    } else if (activeTab === 'crear') {
        const btn = document.querySelectorAll('.tab-btn')[2];
        switchTab('tab-crear', btn);
    } else if (activeTab === 'devlog') {
    const btnDev = Array.from(document.querySelectorAll('.tab-btn')).find(b => b.innerText.includes('DevLog'));
    if (btnDev) switchTab('tab-devlog', btnDev);
    }  else {
        // Por defecto mostrar 'Mi Cuenta'
        const btn = document.querySelector('.tab-btn');
        switchTab('tab-cuenta', btn);
    }
});