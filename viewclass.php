<?php
include 'include/header.php';

	if(!isset($_SESSION['username']))
	{
		header( 'Location: login.php' );
	}
?>

<header id="head" class="secondary">
    <div class="container">
        <h1>Classroom</h1>
        <p>Easy Learn Easy Life.</p>
    </div>
</header>

    
<div class="container">
<h3>Welcome <?php echo $_SESSION["username"] ?> ! This is your timetable.</h3>

<?php 
echo getReservation($studentid);

?>

</div>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/dataTables.min.js"></script>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#scheduleTable').DataTable();
		});
	</script>
<?php
include 'include/footer.php';
?>
