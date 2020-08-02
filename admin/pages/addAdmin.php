<?php 
include 'include/header.php';
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Add Admin Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Admin
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="addadmin.php">
                                        <div class="form-group">
                                            <label>Admin Name</label>
											<input class="form-control" name="aname" placeholder="Admin">
                                        </div>
										<label>Admin Username</label>
                                        <div class="form-group input-group">
											<input class="form-control" name="ausername" placeholder="admin">
                                        </div>
                                        <div class="form-group">
                                            <label>Admin Password</label>
											<input type="password" class="form-control" name="apassword" placeholder="Password">
                                        </div>
                                        <button type="submit" class="btn btn-default" name="addadmin">Add Admin</button>
                                    </form>
									<?php 
									if(isset($_POST['addadmin'])){
										if(!($_POST["aname"]) Or !($_POST["ausername"]) Or !($_POST["apassword"]))
										{
											echo $message = '  <div class="alert alert-danger">
															Please fill in your details.
														  </div>';
										}else{
											$aname = mysqli_real_escape_string($conn,trim($_POST['aname']));
											$ausername = mysqli_real_escape_string($conn,trim($_POST['ausername']));
											$apassword = md5(mysqli_real_escape_string($conn,trim($_POST['apassword'])));
											
											$sql='SELECT * FROM Admin WHERE AUsername="' .$ausername. '"';
											$usernameresult = mysqli_query($conn, $sql);
											
											if(mysqli_num_rows($usernameresult)>0)
											{
												echo $message = '  <div class="alert alert-danger">
																		Username already existed.
																	</div>';
											}else{	
												echo insertAdmin($aname, $ausername, $apassword);
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
