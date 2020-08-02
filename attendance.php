<?php
include 'include/header.php';
require_once 'include/dbConnect.php';
  $clid = $_GET['cid'];
  $cdate =  $_GET['cdte'];

  
	if(!isset($_SESSION['username']))
	{
		header( 'Location: lecturerlogin.php' );
	}
	
?>
<style>
.switch-field {
  font-family: "Lucida Grande", Tahoma, Verdana, sans-serif;
	overflow: hidden;
}

.switch-title {
  margin-bottom: 6px;
}

.switch-field input {
    position: absolute !important;
    clip: rect(0, 0, 0, 0);
    height: 1px;
    width: 1px;
    border: 0;
    overflow: hidden;
}

.switch-field label {
  float: left;
}

.switch-field label {
  display: inline-block;
  width: 60px;
  background-color: #e4e4e4;
  color: rgba(0, 0, 0, 0.6);
  font-size: 14px;
  font-weight: normal;
  text-align: center;
  text-shadow: none;
  padding: 6px 4px;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
  -webkit-transition: all 0.1s ease-in-out;
  -moz-transition:    all 0.1s ease-in-out;
  -ms-transition:     all 0.1s ease-in-out;
  -o-transition:      all 0.1s ease-in-out;
  transition:         all 0.1s ease-in-out;
}

.switch-field label:hover {
	cursor: pointer;
}

.switch-field input:checked + label {
  background-color: #A5DC86;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.switch-field label:first-of-type {
  border-radius: 4px 0 0 4px;
}

.switch-field label:last-of-type {
  border-radius: 0 4px 4px 0;
}
</style>

<header id="head" class="secondary">
    <div class="container">
        <h1>Attendance</h1>
        <p>Easy Learn Easy Life.</p>
    </div>
</header>
  
    <div class="container">
      
        <h1>Student List</h1>
        <div class="table-responsive">
            <table class="table table-striped custab">
                
                <tr>
                    <th>Student Name</th>
                    <th>Course Name</th>
                    <th>Location</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    
                </tr>
                
                <?php
                
                $sql= "SELECT Orders.SID, Orders.ClassID, Orders.CourseID, Student.SName, Course.CourseName, Classroom.Location, Classroom.StartTime, Classroom.EndTime, classroom.ClassDate
                FROM Orders
                INNER JOIN Student ON Orders.SID = Student.SID
                INNER JOIN Classroom ON Orders.ClassID = Classroom.ClassID
                INNER JOIN Course ON Orders.CourseID = Course.CourseID
                WHERE Orders.CourseID = $clid";
                

                $query = mysqli_query($conn, $sql);
                
                $dt = strtotime($result['ClassDate']);
              $day = date("l", $dt);
                $count=1;
                while ($result=mysqli_fetch_array($query)) {
                    echo "
                    <tr>
                    
                        <td>".$result['SName']."</td>
                        <td>".$result['CourseName']."</td>
                        <td>".$result['Location']."</td>
                        <td>".$result['StartTime']."</td>
                        <td>".$result['EndTime']."</td>
                        
                        
            
            </td>
            </tr>";

                    $count++;
                }
                
                
            ?>
            </table>
        </div>


      
          

              
    </div>

	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/dataTables.min.js"></script>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#attendanceTable').DataTable();
		});
	</script>


<?php
include 'include/footer.php';
?>
