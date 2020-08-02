<?php 
include 'include/header.php';

$sql = 'SELECT * FROM Lecturer;';
$result = mysqli_query($conn, $sql);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Add Course Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Course
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="addCourse.php">
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <input type="text" class="form-control" name="course_name" placeholder="Example: PHP Programming">
                                        </div>
										
                                        <div class="form-group">
                                            <label>Course Description</label>
                                            <textarea class="form-control" rows="3" name="course_desc"></textarea>
                                        </div>
										<div class="form-group">
                                            <label>Lecturer</label>
                                            <select class="form-control" name="course_lecturer">
											<?php while($row = mysqli_fetch_assoc($result)){ ?>
                                                <option value="<?php echo $row['LID']; ?>"><?php echo $row['LName']; ?></option>
											<?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Session</label>
                                            <select class="form-control" name="course_session">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Credit Hour/s</label>
                                            <select class="form-control" name="course_hour">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                
                                            </select>
                                        </div>
                                        <button type="submit" name="addcourse" class="btn btn-default">Add Course</button>
                                    </form>
									<?php 
									if(isset($_POST["addcourse"])){
										if(!($_POST["course_name"]) Or !($_POST["course_desc"]))
										{
											echo $message = '  <div class="alert alert-danger">
															Please fill in your details.
														  </div>';
										}else{
											$coursename = $_POST["course_name"];
											$coursedesc = $_POST["course_desc"];
											$courselecturer = $_POST["course_lecturer"];
											$coursesession = $_POST["course_session"];
											$coursehour = $_POST["course_hour"];
											
											echo insertCourse($coursename,$coursedesc,$courselecturer,$coursesession,$coursehour);
										}
									}
									?>
									
                                </div>
                                <!-- /.col-lg-6 (nested) -->

                                <!-- /.col-lg-6 (nested) -->
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

</body>

</html>
