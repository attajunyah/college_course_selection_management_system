<?php
include 'include/header.php';

	if(!isset($_SESSION['username']))
	{
		header( 'Location: login.php' );
	}
	
if(isset($_POST['editstudent'])){
	$sid = $_POST['sid'];
	$sname = $_POST['sname'];
	$spassword = trim($_POST['spassword']);
	
	if($spassword == ''){
	$spassword = $_POST['oldPass'];
	}else{
	$spassword = md5(mysqli_real_escape_string($conn,trim($_POST['spassword'])));
	}
}else{
	$sid = $_SESSION['userid'];

	$editsql = 'SELECT * FROM Student
			WHERE SID = '.$sid.';';

	$editresult = mysqli_query($conn, $editsql);
	$editrow = mysqli_fetch_assoc($editresult);
	
	$sname = $editrow['SName'];
	$spassword = $editrow['SPassword'];
}
?>
 
<header id="head" class="secondary">
    <div class="container">
        <h1>Waiting-List</h1>
        <p>Easy Learn Easy Life.</p>
    </div>
</header>

    
<div class="container">

<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend><h3>Edit Profile</h3></legend>
<input type="hidden" name="sid" value="<?php echo $sid; ?>"/>
<div class="form-group">
  <label class="col-md-4 control-label" for="sname">Student Name</label>  
  <div class="col-md-4">
  <input id="sname" name="sname" type="text" value="<?php echo $sname ?>" class="form-control input-md" /> 
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Password</label>
  <div class="col-md-4">
  <input type="hidden" name="oldPass" value="<?php echo $spassword; ?>">
  <input id="spassword" name="spassword" type="text" placeholder="Enter New Password.." class="form-control input-md" /> 
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="editstudent"></label>
  <div class="col-md-8">
    <button type="submit" id="editstudent" name="editstudent" class="btn btn-success">Edit Profile</button>
  </div>
</div>

</fieldset>
</form>
<?php 
if(isset($_POST['editstudent'])){
	if(!($_POST["sname"])){
	echo $message = '  <div class="alert alert-danger">
						Please fill in your details.
					  </div>';
	}else{
		echo seditprofile($sid,$sname,$spassword);
	}
}
?>

</div>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
	<script src="assets/js/bootstrap.min.js"></script>
<?php
include 'include/footer.php';
?> 