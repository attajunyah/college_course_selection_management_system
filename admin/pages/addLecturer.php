<?php 
include 'include/header.php';
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Add Lecturer Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Lecturer
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="addLecturer.php">
                                        <div class="form-group">
                                            <label>Lecturer Name</label>
											<input class="form-control" name="lname" placeholder="Kumatha">
                                        </div>
										<label>Lecturer Username</label>
                                        <div class="form-group input-group">
											<input class="form-control" name="lusername" placeholder="kumatha123">
                                        </div>
                                        <div class="form-group">
                                            <label>Lecturer Password</label>
											<input type="password" class="form-control" name="lpassword" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-default" name="addlecturer">Add Lecturer</button>
                                    </form>
									<?php 
									if(isset($_POST['addlecturer'])){
										if(!($_POST["lname"]) Or !($_POST["lusername"]) Or !($_POST["lpassword"]))
										{
											echo $message = '  <div class="alert alert-danger">
															Please fill in your details.
														  </div>';
										}else{
											$lname = mysqli_real_escape_string($conn,trim($_POST['lname']));
											$lusername = mysqli_real_escape_string($conn,trim($_POST['lusername']));
											$lpassword = md5(mysqli_real_escape_string($conn,trim($_POST['lpassword'])));
											
											$sql='SELECT * FROM Lecturer WHERE LUsername="' .$lusername. '"';
											$usernameresult = mysqli_query($conn, $sql);
											
											if(mysqli_num_rows($usernameresult)>0)
											{
												echo $message = '  <div class="alert alert-danger">
																		Username already existed.
																	</div>';
											}else{	
												echo insertLecturer($lname, $lusername, $lpassword);
											}
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
