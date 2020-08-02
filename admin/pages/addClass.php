<?php 
include 'include/header.php';
$sql = 'SELECT * FROM Course;';
$result = mysqli_query($conn, $sql);
?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
	<link type="text/css" href="../css/bootstrap-timepicker.min.css" />
	
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Add Session Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Session
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="addClass.php">
                                        <div class="form-group">
                                            <label>Course</label>
                                            <select class="form-control" name="course_id">
											<?php while($row = mysqli_fetch_assoc($result)){ ?>
                                                <option value="<?php echo $row['CourseID']; ?>"><?php echo $row['CourseName']; ?></option>
											<?php } ?>
                                            </select>
                                        </div>
										<label>Classroom Capacity</label>
                                        <div class="form-group input-group">
                                            <select class="form-control" name="capacity">
                                                <option>5</option>
                                                <option>10</option>
                                                <option>15</option>
												<option>20</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input class="form-control" name="location" placeholder="Reading Academy S201">
                                        </div>
										<label>Start Time</label>
										<div class="input-group bootstrap-timepicker timepicker">
											<input id="timepicker1" type="text" class="form-control input-small" name="starttime">
											<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
										</div>
										<label>End Time</label>
										<div class="input-group bootstrap-timepicker timepicker">
											<input id="timepicker1" type="text" class="form-control input-small" name="endtime">
											<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
										</div>
										<div class="form-group">
											<label>Class Date</label>
											<div class="input-group input-append date" id="datePicker">
												<input type="text" class="form-control" name="class_date" />
												<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
											</div>
										</div>
                                        <button type="submit" name="addclass" class="btn btn-default">Add Session</button>
                                    </form>
									<?php 
									if(isset($_POST["addclass"])){
										if(!($_POST["location"]) Or !($_POST["starttime"]) Or !($_POST["class_date"]))
										{
											echo $message = '  <div class="alert alert-danger">
															Please fill in your details.
														  </div>';
										}else{
											$courseid = $_POST["course_id"];
											$capacity = $_POST["capacity"];
											$location = $_POST["location"];
											$starttime = $_POST["starttime"];
											$endtime = $_POST["endtime"];
											$classdate = $_POST["class_date"];
											
											$sqlhour = 'SELECT Hours FROM Course WHERE CourseID = '.$courseid.';';
											$resulthour = mysqli_query($conn, $sqlhour);
											
											$rowhour = mysqli_fetch_assoc($resulthour);
											
											$timestamp = strtotime($starttime);
											$starttime = date('h:i A', $timestamp);
											
											$timestamp2 = strtotime($starttime) + 60*60*$rowhour['Hours'];
											$endtime = date('h:i A', $timestamp2);
											
											echo insertClassroom($courseid,$capacity,$location,$starttime,$endtime,$classdate);
											
										}
									}
									?>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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

	<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
	
	<script type="text/javascript" src="../js/bootstrap-timepicker.min.js"></script>
	
	<script>
	$(document).ready(function() {
		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
		$('#datePicker')
			.datepicker({
				startDate: today,
				autoclose: true,
				format: 'mm/dd/yyyy'
			})
			.on('changeDate', function(e) {
				// Revalidate the date field
				$('#eventForm').formValidation('revalidateField', 'date');
			});

		$('#eventForm').formValidation({
			framework: 'bootstrap',
			icon: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				name: {
					validators: {
						notEmpty: {
							message: 'The name is required'
						}
					}
				},
				date: {
					validators: {
						notEmpty: {
							message: 'The date is required'
						},
						date: {
							format: 'MM/DD/YYYY',
							message: 'The date is not a valid'
						}
					}
				}
			}
		});
	});
	</script>
	<script type="text/javascript">
		$('#timepicker1').timepicker();
	</script>
</body>
</html>
