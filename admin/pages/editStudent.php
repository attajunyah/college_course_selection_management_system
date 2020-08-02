<?php 
include 'include/header.php';

if(isset($_POST['editstudent'])){
	$sid = $_POST['sid'];
	$sname = $_POST['sname'];
	$susername = $_POST['susername'];
	$spassword = trim($_POST['spassword']);
	
	if($spassword == ''){
	$spassword = $_POST['oldPass'];
	}else{
	$spassword = md5(mysqli_real_escape_string($conn,trim($_POST['spassword'])));
	}
}else{
	$sid = $_POST['sid'];

	$editsql = 'SELECT * FROM Student
			WHERE sid = '.$sid.';';

	$editresult = mysqli_query($conn, $editsql);
	$editrow = mysqli_fetch_assoc($editresult);
	
	$sname = $editrow['SName'];
	$susername = $editrow['SUsername'];
	$spassword = $editrow['SPassword'];
}
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Edit Student Form</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Student
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="editStudent.php">
										<input type="hidden" name="sid" value="<?php echo $sid; ?>"/>
                                        <div class="form-group">
                                            <label>Student Name</label>
											<input class="form-control" name="sname" value="<?php echo $sname; ?>" placeholder="Kengwei">
                                        </div>
										<label>Student Username</label>
                                        <div class="form-group input-group">
											<input class="form-control" name="susername" value="<?php echo $susername; ?>" placeholder="kengwei123">
                                        </div>
                                        <div class="form-group">
                                            <label>Student Password</label>
											<input type="password" class="form-control" name="spassword"  placeholder="New Password">
											<input type="hidden" name="oldPass" value="<?php echo $spassword; ?>">
                                        </div>
                                        <button type="submit" class="btn btn-default" name="editstudent">Edit Student</button>
										<a href="viewStudent.php" class="btn btn-default" role="button">View Student</a>
                                    </form>
									<?php 
									if(isset($_POST['editstudent'])){
										if(!($_POST["sname"]) Or !($_POST['susername'])){
										echo $message = '  <div class="alert alert-danger">
															Please fill in your details.
														  </div>';
										}else{
											echo editStudent($sid,$sname,$susername,$spassword);
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
