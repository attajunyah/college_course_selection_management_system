<?php 
include 'include/header.php';

if(isset($_POST['editadmin'])){
	$aid = $_POST['aid'];
	$aname = $_POST['aname'];
	$ausername = $_POST['ausername'];
	
	$apassword = trim($_POST['apassword']);
	
	if($apassword == ''){
	$apassword = $_POST['oldPass'];
	}else{
	$apassword = md5(mysqli_real_escape_string($conn,trim($_POST['apassword'])));
	}
}else{
	$aid = $_SESSION['Auserid'];

	$editsql = 'SELECT * FROM Admin
			WHERE AID = '.$aid.';';

	$editresult = mysqli_query($conn, $editsql);
	$editrow = mysqli_fetch_assoc($editresult);
	
	$aname = $editrow['AName'];
	$ausername = $editrow['AUsername'];
	$apassword = $editrow['APassword'];
}
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="page-header">Edit Admin Profile</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Profile
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="aeditprofile.php">
										<input type="hidden" name="aid" value="<?php echo $aid; ?>"/>
                                        <div class="form-group">
                                            <label>Admin Name</label>
											<input class="form-control" name="aname" value="<?php echo $aname; ?>" placeholder="Kumatha">
                                        </div>
										<label>Admin Username</label>
                                        <div class="form-group input-group">
											<input class="form-control" name="ausername" value="<?php echo $ausername; ?>" placeholder="kumatha123">
                                        </div>
                                        <div class="form-group">
                                            <label>Admin Password</label>
											<input type="password" class="form-control" name="apassword" placeholder="New Password">
											<input type="hidden" name="oldPass" value="<?php echo $apassword; ?>">
                                        </div>
                                        <button type="submit" class="btn btn-default" name="editadmin">Edit Profile</button>
                                    </form>
									<?php 
									if(isset($_POST['editadmin'])){
										if(!($_POST["aname"]) Or !($_POST['ausername'])){
										echo $message = '  <div class="alert alert-danger">
															Please fill in your details.
														  </div>';
										}else{
											echo aeditprofile($aid,$aname,$ausername,$apassword);
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
