<?php 
include 'include/header.php';
$sql = 'SELECT * FROM Course;';
$result = mysqli_query($conn, $sql);
?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
	<link rel="stylesheet" href="../../assets/css/dataTables.min.css">
	<link type="text/css" href="../css/bootstrap-timepicker.min.css" />
	
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">View Requests</h1>
                    </div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				
				<div class="row">
					<div class="table-responsive table-bordered">
					<?php
						echo getOrdersAdmin();
						
					?>
					</div>
				</div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
	<script src="../../assets/js/dataTables.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#orderTable').DataTable();
		});
	</script>
</body>
</html>
