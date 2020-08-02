<?php 
include 'include/header.php';

if(isset($_POST['editlecturer'])){
	$lid = $_POST['lid'];
	$lname = $_POST['lname'];
	$lusername = $_POST['lusername'];
	
	$lpassword = trim($_POST['lpassword']);
	
	if($lpassword == ''){
	$lpassword = $_POST['oldPass'];
	}else{
	$lpassword = md5(mysqli_real_escape_string($conn,trim($_POST['lpassword'])));
	}
}else{
	$lid = $_POST['lid'];

	$editsql = 'SELECT * FROM Lecturer
			WHERE LID = '.$lid.';';

	$editresult = mysqli_query($conn, $editsql);
	$editrow = mysqli_fetch_assoc($editresult);
	
	$lname = $editrow['LName'];
	$lusername = $editrow['LUsername'];
	$lpassword = $editrow['LPassword'];
}
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Edit Lecturer Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Lecturer
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="editLecturer.php">
										<input type="hidden" name="lid" value="<?php echo $lid; ?>"/>
                                        <div class="form-group">
                                            <label>Lecturer Name</label>
											<input class="form-control" name="lname" value="<?php echo $lname; ?>" placeholder="Kumatha">
                                        </div>
										<label>Lecturer Username</label>
                                        <div class="form-group input-group">
											<input class="form-control" name="lusername" value="<?php echo $lusername; ?>" placeholder="kumatha123">
                                        </div>
                                        <div class="form-group">
                                            <label>Lecturer Password</label>
											<input type="password" class="form-control" name="lpassword" placeholder="New Password">
											<input type="hidden" name="oldPass" value="<?php echo $lpassword; ?>">
                                        </div>
                                        <button type="submit" class="btn btn-default" name="editlecturer">Edit Lecturer</button>
										<a href="viewLecturer.php" class="btn btn-default" role="button">View Lecturer</a>
                                    </form>
									<?php 
									if(isset($_POST['editlecturer'])){
										if(!($_POST["lname"]) Or !($_POST['lusername'])){
										echo $message = '  <div class="alert alert-danger">
															Please fill in your details.
														  </div>';
										}else{
											echo editLecturer($lid,$lname,$lusername,$lpassword);
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
	
    <script src="../vendor/jquery/jquery.min.js"></script>

    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
