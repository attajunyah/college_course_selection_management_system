<?php
include 'include/header.php';

if(isset($_SESSION['username']))
{
	header( 'Location: course.php' );
}

if($_POST){
    $username   = mysqli_real_escape_string($conn,trim($_POST['lecturerName']));
	$password   = md5(mysqli_real_escape_string($conn,trim($_POST['lecturerPassword'])));
	
	lecturerLogin($username,$password);
}
?>
<style>
@import "bourbon";

body {
	background: #eee !important;	
}

.wrapper {	
	margin-top: 80px;
  margin-bottom: 80px;
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color: #fff;
  border: 1px solid rgba(0,0,0,0.1);  

  .form-signin-heading,
	.checkbox {
	  margin-bottom: 30px;
	}

	.checkbox {
	  font-weight: normal;
	}

	.form-control {
	  position: relative;
	  font-size: 16px;
	  height: auto;
	  padding: 10px;
		@include box-sizing(border-box);

		&:focus {
		  z-index: 2;
		}
	}

	input[type="text"] {
	  margin-bottom: -1px;
	  border-bottom-left-radius: 0;
	  border-bottom-right-radius: 0;
	}

	input[type="password"] {
	  margin-bottom: 20px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
}
</style>

<header id="head" class="secondary">
    <div class="container">
        <h1>Login Page</h1>
        <p>Easy Learn Easy Life.</p>
    </div>
</header>

    
<div class="container">
  <div class="wrapper">
    <form class="form-signin" method="post" action="lecturerlogin.php">       
      <h2 class="form-signin-heading">Lecturer Login</h2>
      <input type="text" class="form-control" name="lecturerName" placeholder="Username" required="" autofocus="" />
      <input type="password" class="form-control" name="lecturerPassword" placeholder="Password" required=""/>      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	  <?php
	  if (isset($_SESSION['errorstudent'])){
	  echo '<div class="alert alert-danger">
				<strong>Fail to Login!</strong> '.$_SESSION['errorstudent'].'
			</div>';
	  unset($_SESSION['errorstudent']);
	  }
	  ?>
    </form>
  </div>
</div>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
	<script src="assets/js/bootstrap.min.js"></script> 
<?php
include 'include/footer.php';
?>
