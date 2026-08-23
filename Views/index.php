


<?php include 'Layouts/main.php'; ?>

<div class="y2k-app-layout">

<?php include 'Layouts/navbar.php'; ?>

<?php include 'Layouts/sidebar.php'; ?>

</div>

<!-- Modal Y2K del Calendario Agenda -->
<?php include 'Layouts/modal.php'; ?>

<script>
	function toggleCalendarModal(show) {
		const modal = document.getElementById('calendarModal');
		modal.classList.toggle('active', show);
	}
</script>

</body>
</html>

</body>
</html>