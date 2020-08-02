<?php 
include 'include/header.php';

// binding data to select option
$sql = 'SELECT * FROM Lecturer;';
$result = mysqli_query($conn, $sql);


if(isset($_POST["editcourse"])){
$courseid = $_POST['courseid'];
$coursename = $_POST["course_name"];
$coursedesc = $_POST["course_desc"];
$courselecturer = $_POST["course_lecturer"];
$coursesession = $_POST["course_session"];
$coursehour = $_POST["course_hour"];
}else{
$courseid = $_POST['courseid'];
$editsql = 'SELECT * FROM Course
		WHERE CourseID = '.$courseid.';';
$editresult = mysqli_query($conn, $editsql);
$editrow = mysqli_fetch_assoc($editresult);

$coursename = $editrow['CourseName'];
$coursedesc = $editrow['CourseDesc'];
$courselecturer = $editrow['LID'];
$coursesession = $editrow['Session'];
$coursehour = $editrow['Hours'];
}
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Edit Course Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Course
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="editCourse.php">
										<input type="hidden" name="courseid" value="<?php echo $courseid; ?>"/>
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <input type="text" class="form-control" name="course_name" value="<?php echo $coursename; ?>" placeholder="Example: PHP Programming">
                                        </div>
										<label>Course Description</label>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="3" name="course_desc"><?php echo $coursedesc; ?></textarea>
                                        </div>
										<div class="form-group">
                                            <label>Lecturer</label>
                                            <select class="form-control" name="course_lecturer">
											<?php while($row = mysqli_fetch_assoc($result)){ ?>
                                                <option value="<?php echo $row['LID']; ?>" 
												<?php if($courselecturer == $row['LID']){ echo "selected"; } ?>><?php echo $row['LName']; ?></option>
											<?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Session</label>
                                            <select class="form-control" name="course_session">
											  <option value="1" 
											  <?php 
												if($coursesession == "1"){
													echo "selected";
												}
											  ?>
											  >1</option>
											  <option value="2" 
											  <?php 
												if($coursesession == "2"){
													echo "selected";
												}
											  ?>
											  >2</option>
											  <option value="3" 
											  <?php 
												if($coursesession == "3"){
													echo "selected";
												}
											  ?>
											  >3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Hour/s</label>
                                            <select class="form-control" name="course_hour">
											  <option value="1" 
											  <?php 
												if($coursehour == "1"){
													echo "selected";
												}
											  ?>
											  >1</option>
											  <option value="2" 
											  <?php 
												if($coursehour == "2"){
													echo "selected";
												}
											  ?>
											  >2</option>
											  <option value="3" 
											  <?php 
												if($coursehour == "3"){
													echo "selected";
												}
											  ?>
											  >3</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="editcourse" class="btn btn-default">Edit Course</button>
										<a href="viewCourse.php" class="btn btn-default" role="button">View Course</a>
                                    </form>
									<?php 
									if(isset($_POST["editcourse"])){
										if(!($_POST["course_name"]) Or !($_POST["course_desc"]))
										{
											echo $message = '  <div class="alert alert-danger">
															Please fill in your details.
														  </div>';
										}
										else{
											echo editCourse($courseid,$coursename,$coursedesc,$courselecturer,$coursesession,$coursehour);
										}
									}
									?>
									
                                </div>
                            </div>
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
