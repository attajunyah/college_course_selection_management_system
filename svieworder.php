<?php
include 'include/header.php';

	if(!isset($_SESSION['username']))
	{
		header( 'Location: login.php' );
	}
	
$sid = $_SESSION['userid']; 
?>
<style>
.btn { padding: 10px 10px; }
.pay { float:left; }
.cancel { float:right; }
</style>
 
<header id="head" class="secondary">
    <div class="container">
        <h1>Request</h1>
        <p>Easy Learn Easy Life.</p>
    </div>
</header>

    
<div class="container">
<h3>Your Request</h3>


					<?php
					echo getOrdersStudent($sid);//Display classroo

					//Cancel Order
					$cl = $_GET['oid'];
					
					echo cancelOrders($cl);

					
					
						
					?>

</div>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/dataTables.min.js"></script>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#orderTable').DataTable();
		});
	</script>
<?php
include 'include/footer.php';
?> 