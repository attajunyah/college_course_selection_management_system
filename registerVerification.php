<?php
include 'include/header.php';
	
	if(isset($_SESSION['username']))
	{
		header( 'Location: course.php' );
	}


//Edit Email
if($_POST['changemail']){
	if(!isset($_POST['email']))
	{
		$message = '	<div class="alert alert-danger">
						Please Enter Your Email.
					  </div>';
	}
	// validate email format
	elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$message = '  <div class="alert alert-danger">
						Invalid Email.
					  </div>';
	}
	
		
}

?>
<style>
body, html{
     height: 100%;
 	background-repeat: no-repeat;
 	background-color: #d3d3d3;
 	font-family: 'Oxygen', sans-serif;
}

.main{
 	margin-top: 70px;
}

h1.title { 
	font-size: 50px;
	font-weight: 400; 
}

hr{
	width: 10%;
	color: #fff;
}

.form-group{
	margin-bottom: 15px;
}

label{
	margin-bottom: 15px;
}

input,
input::-webkit-input-placeholder {
    font-size: 11px;
    padding-top: 3px;
}

.main-login{
 	background-color: #fff;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

}

.main-center{
 	margin-top: 30px;
 	margin: 0 auto;
 	max-width: 330px;
    padding: 15px 40px;

}

.login-button{
	margin-top: 5px;
}

.login-register{
	font-size: 11px;
	text-align: center;
}
</style>
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title">Email Verification - Registration</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="registerVerification.php">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">Enter Verification Code here</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="verifycode" id="verifycode"  placeholder="Enter Verification Code"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<input type="submit" value="Verify" name="verify" class="btn btn-primary btn-lg btn-block login-button"/>
						</div>
					</form>
					<?php echo $verifymessage; ?>
				</div>
				
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="registerVerification.php">
						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Change Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="email" id="email"  placeholder="Enter your Email"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<input type="submit" value="Change" name="changemail" class="btn btn-primary btn-lg btn-block login-button"/>
						</div>
					</form>
					<?php echo $message; ?>
				</div>
			</div>
		</div>

<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
	<script src="assets/js/bootstrap.min.js"></script>
<?php
include 'include/footer.php';
?>
