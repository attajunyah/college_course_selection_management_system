<?php
include 'include/header.php';


if($_POST){
	if(isset($_POST['btn_send'])){
    $name   = mysqli_real_escape_string($conn,trim($_POST['name']));
	$email  = mysqli_real_escape_string($conn,trim($_POST['email']));
	$subject  = mysqli_real_escape_string($conn,trim($_POST['subject']));
	$message  = mysqli_real_escape_string($conn,trim($_POST['message']));
	}
}
?>
 	<header id="head" class="secondary">
            <div class="container">
                    <h1>Contact Us</h1>
                </div>
    </header>


    <!-- container -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="section-title">Address</h3>
				<div class="contact-info">
					<h5>Address</h5>
					<p>College of International Students,Reading Academy, NUIST.</p>
					
					<h5>Email</h5>
					<p>mikexzibit25@nuist.edu.cn</p>
					
					<h5>Phone</h5>
					<p>+86 (156) 15651713611</p>
				</div>
				<div class="contact-info">
				
				</div>
			</div> 
		</div> 						
	</div>
				
  <script type='text/javascript' src='assets/js/jquery.min.js'></script> 
<script src="assets/js/bootstrap.min.js"></script>   



<?php
include 'include/footer.php';
?>