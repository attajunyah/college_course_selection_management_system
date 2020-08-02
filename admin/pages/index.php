<?php 
include 'include/header.php'; 
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php
						  		$sql='SELECT * FROM Classroom';
								$result = mysqli_query($conn, $sql);
								$rowcount = mysqli_num_rows($result);
						            echo $rowcount;
								?></div>
                                    <div>View Classroom!</div>
                                </div>
                            </div>
                        </div>
                        <a href="viewClass.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php
						  		$sql='SELECT * FROM Orders';
								$result = mysqli_query($conn, $sql);
								$rowcount = mysqli_num_rows($result);
						            echo $rowcount;
								?></div>
                                    <div>New Requests!</div>
                                </div>
                            </div>
                        </div>
                        <a href="viewOrder.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php
						  		$sql='SELECT * FROM Student';
								$result = mysqli_query($conn, $sql);
								$rowcount = mysqli_num_rows($result);
						            echo $rowcount;
								?></div>
                                    <div>View Students!</div>
                                </div>
                            </div>
                        </div>
                        <a href="viewStudent.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Statistical Analysis - Number of Classroom by Course (Bar Chart)
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8" >
                                    <div id="morris-bar-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Statistical Analysis - Users (Donut Chart) 
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Statistical Analysis - Number of Students by Course (Line Chart) 
                        </div>
                        <div class="panel-body">
                            <div id="morris-line-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <!-- <script src="../data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
	<script type="text/javascript">
    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Students",
            value: <?php
						  		$sql='SELECT * FROM Student';
								$result = mysqli_query($conn, $sql);
								$rowcount = mysqli_num_rows($result);
						            echo $rowcount;
						?>
        }, {
            label: "Lecturers",
            value: <?php
						  		$sql='SELECT * FROM Lecturer';
								$result = mysqli_query($conn, $sql);
								$rowcount = mysqli_num_rows($result);
						            echo $rowcount;
						?>
        }, {
            label: "Admins",
            value: <?php
						  		$sql='SELECT * FROM Admin';
								$result = mysqli_query($conn, $sql);
								$rowcount = mysqli_num_rows($result);
						            echo $rowcount;
						?>
        }],
        resize: true
    });
	
	Morris.Line({
        element: 'morris-line-chart',
        data: 	<?php
		echo "[";
		$sql = 'SELECT * FROM Course';
		$result = mysqli_query($conn,$sql);
		
		while($row = mysqli_fetch_assoc($result)){
			$courseID = $row['CourseID'];
			$courseName = $row['CourseName'];
			$sql ="SELECT CRID from Classreservation WHERE CourseID =".$courseID.";";
			$resultnumber = mysqli_query($conn,$sql);
			$cnum = mysqli_num_rows($resultnumber);
			echo "{course: '".$courseName."', number:". $cnum."},";
		}
		echo "]";
		?>,
        xkey: 'course',
        ykeys: ['number'],
        labels: ['Student'],
		lineWidth: '2px',
		hideHover: true,
		ymax: 'auto',
		xLabelAngle: 70,
		setAxisAlignFirstX: true,
	    parseTime:false
    });

    Morris.Bar({
		barGap:5,
		barSize: 50,
		xLabelAngle: 50,
        element: 'morris-bar-chart',
        data: 	<?php
		echo "[";
		$sql = 'SELECT * FROM Course';
		$result = mysqli_query($conn,$sql);
		
		while($row = mysqli_fetch_assoc($result)){
			$courseID = $row['CourseID'];
			$courseName = $row['CourseName'];
			$sql ="SELECT ClassID from Classroom WHERE CourseID =".$courseID.";";
			$resultnumber = mysqli_query($conn,$sql);
			$cnum = mysqli_num_rows($resultnumber);
			echo "{course: '".$courseName."', number:". $cnum."},";
		}
		echo "]";
		?>,
        xkey: 'course',
        ykeys: ['number'],
        labels: ['Classroom'],
        hideHover: 'auto',
        resize: true
    });
	$('#morris-bar-chart svg').height(420);
	$('#morris-line-chart svg').height(450);
</script>

</body>

</html>
