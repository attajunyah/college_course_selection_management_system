<?php
include 'include/header.php';

	if(!isset($_SESSION['username']))
	{
		header( 'Location: lecturerlogin.php' );
	}
	
if(isset($_POST['editlecturer'])){
	$lid = $_POST['lid'];
	$lname = $_POST['lname'];
	$lpassword = trim($_POST['lpassword']);
	
	if($lpassword == ''){
	$lpassword = $_POST['oldPass'];
	}else{
	$lpassword = md5(mysqli_real_escape_string($conn,trim($_POST['lpassword'])));
	}
}else{
	$lid = $_SESSION['Luserid'];

	$editsql = 'SELECT * FROM Lecturer
			WHERE LID = '.$lid.';';

	$editresult = mysqli_query($conn, $editsql);
	$editrow = mysqli_fetch_assoc($editresult);
	
	$lname = $editrow['LName'];
	$lpassword = $editrow['LPassword'];
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
<input type="hidden" name="lid" value="<?php echo $lid; ?>"/>
<div class="form-group">
  <label class="col-md-4 control-label" for="lname">Lecturer Name</label>  
  <div class="col-md-4">
  <input id="lname" name="lname" type="text" value="<?php echo $lname ?>" class="form-control input-md" /> 
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Password</label>
  <div class="col-md-4">
  <input type="hidden" name="oldPass" value="<?php echo $lpassword; ?>">
  <input id="lpassword" name="lpassword" type="text" placeholder="Enter New Password.." class="form-control input-md" /> 
  </div>
</div>

<div class="form-group">
	<label class="col-md-4 control-label" for="editlecturer"></label>
  <div class="col-md-8">
    <button type="submit" id="editlecturer" name="editlecturer" class="btn btn-success">Edit Profile</button>
  </div>
</div>

</fieldset>
</form>
<?php 
if(isset($_POST['editlecturer'])){
	if(!($_POST["lname"])){
	echo $message = '  <div class="alert alert-danger">
						Please fill in your details.
					  </div>';
	}else{
		echo leditprofile($lid,$lname,$lpassword);
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