<?php
include 'include/header.php';

	if(!isset($_SESSION['username']))
	{
		header( 'Location: login.php' );
	}
?>
<style>
.btn { padding: 10px 10px; }
</style>
 
<header id="head" class="secondary">
    <div class="container">
        <h1>Session</h1>
        <p>Easy Learn Easy Life.</p>
    </div>
</header>

    
<div class="container">
<h3>Available Session</h3>

<?php

//Display classroom
if(isset($_POST['course_id']) AND isset($_SESSION['userid'])){
echo getClass($_POST['course_id']);
}elseif(isset($_POST['course_id']) AND isset($_SESSION['Luserid'])){
echo getClassLecturer($_POST['course_id']);	
}

//Register Class 
if(isset($_POST['register'])){
	if(isset($_POST['class_id']) AND isset($_POST['course_id'])){
		$classid = $_POST['class_id'];
		$courseid = $_POST['course_id'];
		
		$sid = $_SESSION['userid'];
		
		// Get Session Date
		$sql = 'SELECT ClassDate FROM Classroom
				WHERE ClassID = '.$classid.';';
		$resultdate = mysqli_query($conn, $sql);
		$rowdate = mysqli_fetch_assoc($resultdate);
		
		//if specific class registered, then won't add to waiting list again.
		$sql = 'SELECT Orders.ClassID, SID, Classroom.ClassDate
				FROM Orders
				INNER JOIN Classroom ON Orders.ClassID = Classroom.ClassID
				WHERE Orders.ClassID = '.$classid.' AND SID = '.$sid.' AND Classroom.ClassDate = "'.$rowdate['ClassDate'].'";';
		$result = mysqli_query($conn, $sql);
		
		if(!mysqli_num_rows($result) > 0){
		echo insertOrders($classid,$courseid,$sid);
		}else{
			$msg = '<div class="alert alert-warning">
					<strong>Warning!</strong> You have already registered this class!
					</div>';
			echo $msg;
		}
	}
}



?>

</div>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	 <script type='text/javascript' src='assets/js/jquery_classroom.min.js'></script> 
	<script src="assets/js/bootstrap.min.js"></script> 
	
	<script src="assets/js/dataTables.min.js"></script>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#classroomTable').DataTable();
		});
	</script>
	
 <script>
 $(document).ready(function(){  
      $(document).on('click', '.view_data', function(){  
           var class_id = $(this).attr("id");  
           if(class_id != '')  
           {  
                $.ajax({  
                     url:"include/function.php",  
                     method:"POST",  
                     data:{class_session_id:class_id},  
                     success:function(data){  
                          $('#employee_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 }); 
 </script>
	
<?php
include 'include/footer.php';
?>
 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Session Details</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  