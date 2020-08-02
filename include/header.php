<?php 
ob_start();
include 'include/dbConnect.php';
include 'include/function.php';
error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Course Selection System">
	<title>Course Selection System</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/dataTables.min.css">
	<link rel='stylesheet' id='camera-css'  href='assets/css/camera.css' type='text/css' media='all'>
</head>
<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				<a class="navbar-brand" href="index.php">
					<img src="assets/images/newlogo.png" alt="NUIST Logo">COURSE SELECTION MANAGEMENT SYSTEM</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right mainNav">
					<?php if(!isset($_SESSION["username"])){ ?>
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li><a href="register.php">Register</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">User Login <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="login.php">Student Login</a></li>
							<li><a href="lecturerlogin.php">Lecturer Login</a></li>
							<li><a href="admin/pages/login.php">Admin Login</a></li>
						</ul>
					</li>
					<?php }?>
					<?php if(isset($_SESSION["userid"])){ ?>
					<li><a href="index.php">Home</a></li>
					<li><a href="course.php"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> View Courses</a></li>
					<li><a href="svieworder.php"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> My Requests</a></li>
					
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-user' aria-hidden='true'></span> <?php echo $_SESSION["username"] . " (Student)"; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="seditprofile.php"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit Profile</a></li>
							<li><a href="logout.php"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout</a></li>
						</ul>
					</li>
					<?php }elseif(isset($_SESSION["Luserid"])){?>
					<li><a href="index.php">Home</a></li>
					<li><a href="course.php"><span class='glyphicon glyphicon-calendar' aria-hidden='true'></span> View Timetable</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-user' aria-hidden='true'></span> <?php echo $_SESSION["username"] . " (Lecturer)"; ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="leditprofile.php"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Edit Profile</a></li>
							<li><a href="logout.php"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout</a></li>
						</ul>
					</li>
					<?php }?>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->
