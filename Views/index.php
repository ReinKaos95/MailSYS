<?php include 'Layouts/main.php'; ?>

<div class="app-layout">
    <!-- Navbar arriba del todo -->
    <?php include 'Layouts/navbar.php'; ?>

    <!-- Contenedor principal (Sidebar + Bandeja) -->
    <?php include 'Layouts/sidebar.php'; ?>
</div>

<!-- Modal de la Agenda -->
<?php include 'Layouts/modal.php'; ?>

<script>
    function toggleCalendarModal(show) {
        const modal = document.getElementById('calendarModal');
        if (modal) {
            modal.style.display = show ? 'flex' : 'none';
        }
    }
</script>

</body>
</html>