<?php
include 'include/header.php';
	if(!isset($_SESSION['username']))
	{
		header( 'Location: login.php' );
	}

// 6 courses will be displaying in per page
$per_page=6;
if (isset($_GET["page"])) {
$page = $_GET["page"];
}
else {
$page=1;
}
	
//Calculate where to start from
$start_from = ($page-1) * $per_page;
?>

<header id="head" class="secondary">
    <div class="container">
        <h1>Courses</h1>
        <p>Easy Learn Easy Life.</p>
    </div>
</header>

    
<div class="container">
<h3>Available Courses</h3>
<br/>
<div>
<?php
if (isset($_SESSION['userid'])){
	getCourse($start_from,$per_page);
}elseif (isset($_SESSION['Luserid'])){
	getCourseLecturer($_SESSION['Luserid'],$start_from,$per_page);
}

?>
</div>


</div>
	
<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
	<script src="assets/js/bootstrap.min.js"></script> 
	
	 <footer id="footer">
<?php
include 'include/footer.php';
?>
