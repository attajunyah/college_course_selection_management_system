<?php 
session_start();
require 'dbConnect.php';


// Student Member Registration
function studentRegistration($username,$pass,$email,$name){
require 'dbConnect.php';	
//Code for Registration 
if(isset($_POST['register']))
{
	$name=$_POST['SName'];
	$username=$_POST['SUsername'];
	$pass=$_POST['SPassword'];
	$email=$_POST['SEmail'];
	
	
	
	$insertsql='INSERT INTO Student (SName,SUsername,SPassword,SEmail) VALUES
		  ("'.$name.'","'.$username.'","'.$pass.'","'.$email.'");';
	$insertresult = mysqli_query($conn, $insertsql);
if($insertresult) {
	echo "<script>alert('Register successfully');</script>";
}
else {
	echo "<script>alert('Error');</script>";
}
}

   
}



// Student Login
function studentLogin($username,$password){
require 'dbConnect.php';
		
        $sqlstudent = 'SELECT * FROM Student WHERE SUsername="'.$username.'" AND SPassword="'.$password.'"';
		
		$resultstudent = mysqli_query($conn,$sqlstudent);
			if (mysqli_num_rows($resultstudent)==1){
				$row = mysqli_fetch_assoc($resultstudent);
				
				$_SESSION['username'] = $row['SName'];
				$_SESSION['userid'] = $row['SID'];
					
					header( 'Location: course.php' );
				
			}else{
				$errormsg = 'Username or Password incorrect!';
				$_SESSION['errorstudent'] = $errormsg;
			}
			return $msg;
}

// Student - Edit Student
 function seditprofile($sid,$sname,$spw){
	include 'dbConnect.php';

	$updatesql = 'UPDATE Student 
				SET SName = "'.$sname.'", SPassword = "'.$spw.'"
				WHERE SID = '.$sid.';';
	$update = mysqli_query($conn, $updatesql);
	
	if($update){

		$msg =  ' <div class="alert alert-success">
					<strong>Success!</strong> Successfully Edited.
				  </div>';
	}else{
		$msg = '  <div class="alert alert-danger">
					<strong>Danger!</strong> Please Contact Admin! Something went wrong.
				  </div>';
	}	
	echo $msg;
}

// Lecturer Login
function lecturerLogin($username,$password){
require 'dbConnect.php';
		
        $sqlLecturer = 'SELECT * FROM Lecturer WHERE LUsername="'.$username.'" AND LPassword="'.$password.'"';
		
		$resultLecturer = mysqli_query($conn,$sqlLecturer);
			if (mysqli_num_rows($resultLecturer)==1){
				$row = mysqli_fetch_assoc($resultLecturer);
					
					$_SESSION['username'] = $row['LName'];
					$_SESSION['Luserid'] = $row['LID'];
					
					header( 'Location: course.php' );
				
			}else{
				$errormsg = 'Username or Password incorrect!';
				$_SESSION['errorstudent'] = $errormsg;
			}
}

// Lecturer - Edit Lecturer
 function leditprofile($lid,$lname,$lpw){
	include 'dbConnect.php';

	$updatesql = 'UPDATE Lecturer 
				SET LName = "'.$lname.'", LPassword = "'.$lpw.'"
				WHERE LID = '.$lid.';';
	$update = mysqli_query($conn, $updatesql);
	
	if($update){

		$msg =  ' <div class="alert alert-success">
					<strong>Success!</strong> Successfully Edited.
				  </div>';
	}else{
		$msg = '  <div class="alert alert-danger">
					<strong>Danger!</strong> Please Contact Admin! Something went wrong.
				  </div>';
	}	
	echo $msg;
}

// Admin Login
function adminLogin($username,$password){
require 'dbConnect.php';
		
        $sqladmin = 'SELECT * FROM Admin WHERE AUsername="'.$username.'" AND APassword="'.$password.'"';
		
		$resultadmin = mysqli_query($conn,$sqladmin);
			if (mysqli_num_rows($resultadmin)==1){
				$row = mysqli_fetch_assoc($resultadmin);
					
					$_SESSION['Aname'] = $row['AName'];
					$_SESSION['Ausername'] = $username;
					$_SESSION['Auserid'] = $row['AID'];
					
					header( 'Location: index.php' );
				
			}else{
				$errormsg = 'Username or Password incorrect!';
				$_SESSION['erroradmin'] = $errormsg;
			}
}

// Admin - Edit Profile
 function aeditprofile($aid,$aname,$ausername,$apw){
	include 'dbConnect.php';

	$updatesql = 'UPDATE Admin 
				SET AName = "'.$aname.'", AUsername = "'.$ausername.'", APassword = "'.$apw.'"
				WHERE AID = '.$aid.';';
	$update = mysqli_query($conn, $updatesql);
	
	if($update){

		$msg =  ' <div class="alert alert-success">
					<strong>Success!</strong> Successfully Edited.
				  </div>';
	}else{
		$msg = '  <div class="alert alert-danger">
					<strong>Danger!</strong> Please Contact Admin! Something went wrong.
				  </div>';
	}	
	echo $msg;
}

// Get Course from Database
function getCourse($start_from,$per_page){
include 'dbConnect.php';
$sql= 'SELECT * FROM course LIMIT '.$start_from.','.$per_page.';';
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		echo '<div id="products" class="row list-group">';
		while($row = mysqli_fetch_assoc($result)){	
			echo '<div class="item  col-xs-4 col-lg-4">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/400x250/000/fff&text='.$row["CourseName"].'" />
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							'.$row["CourseName"].'</h4>
						<p class="group inner list-group-item-text">
							'.$row["CourseDesc"].'</p>
						<div class="row">
							
							<div class="col-xs-12 col-md-6">
							<form method="post" action="classroom.php">
							<div><input type="hidden" name="course_id" value="'.$row["CourseID"].'"/></div>
							<input class="btn btn-success" type="submit" name="view" value="View Sessions"/>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>';
			}
			echo '</div>';
			
			//Now select all from table
			$querypage = "SELECT * FROM Course;";

			$resultpage = mysqli_query($conn, $querypage);

			// Count the total records
			$total_records = mysqli_num_rows($resultpage);

			//Using ceil function to divide the total records on per page
			$total_pages = ceil($total_records / $per_page);
			
			//first page
			echo "<ul class='pagination'>
				 <li class='page-item'><a href='course.php?page=1'>".'<<'."</a></li>";

			for ($i=1; $i<=$total_pages; $i++) {

			echo "<li class='page-item'><a href='course.php?page=".$i."'>".$i."</a></li>";
			};
			// last page
			echo "<li class='page-item'><a href='course.php?page=$total_pages'>".'>>'."</a></li>
				</ul>";
		}
	}else{
		echo 'Error Database!';
	}
}

// Get Classroom from Database
function getClass($courseid){
include 'dbConnect.php';
$sql= 'SELECT ClassID, Course.CourseID, Course.CourseName, Slot, Capacity, Course.Session, Course.Hours, Location, StartTime, EndTime, ClassDate 
FROM Classroom
INNER JOIN Course ON Classroom.CourseID = Course.CourseID
WHERE Classroom.CourseID = '.$courseid.' And Classroom.ClassDate >= DATE_FORMAT(CURDATE(), "%m/%d/%Y");';
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		$view = '<table id="classroomTable" class="table table-striped custab">
				<thead>
					<tr>
						<th>Classroom ID</th>
						<th>Course Name</th>
						<th>Capacity</th>
						<th>Session</th>
						<th>Hours</th>
						<th>Location</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Class Date</th>
						<th class="text-center">Action</th>
					</tr>
				</thead><tbody>';


		while($row = mysqli_fetch_assoc($result))
		{
		$view.= '<tr>
                <td>'.$row['ClassID'].'</td>
                <td width="30%">'.$row['CourseName'].'</td>
				<td>'.$row['Slot'].' / '.$row['Capacity'].'</td>
				<td>'.$row['Session'].'</td>
				<td>'.$row['Hours'].'</td>
				<td>'.$row['Location'].'</td>
				<td>'.$row['StartTime'].'</td>
				<td>'.$row['EndTime'].'</td>
				<td>'.$row['ClassDate'].'</td>
                <td width="50%">
				<form method="post" action="classroom.php">
				<div><input type="hidden" name="class_id" value="'.$row["ClassID"].'"/></div>
				<div><input type="hidden" name="course_id" value="'.$row["CourseID"].'"/></div>
				
				<input class="btn btn-warning" type="submit" name="register" value="Register Class"/>&nbsp;';
		
		
		$view.=	'</form>
				</td>
				</tr>';
		}
		$view.= '</tbody></table>';
	}else{
		$view = '<div class="alert alert-danger">
				  No Class Available!
				</div>';
	}
}
else{$view = 'Database Connection Error.';
}
	return $view;
}

// Student - Insert classroom into orders table - Register Classroom
function insertOrders($classid,$courseid,$sid){
	include 'dbConnect.php';
	
	// Turn off autocommit, in order to make every query run successfully
	mysqli_autocommit($conn,FALSE);
	
	// To validate whether the classroom is full or not
	$sql = 'SELECT * FROM Classroom
			WHERE ClassID = '.$classid.';';
	$result = mysqli_query($conn, $sql);
	$validate = mysqli_fetch_assoc($result);
	
	if($validate['Capacity'] > $validate['Slot']){
		$today = date("m/d/Y"); 
		$insertsql = 'INSERT INTO Orders (ClassID, CourseID, SID,OrderDate) 
		VALUES ('.$classid.', '.$courseid.', '.$sid.', "'.$today.'")';
		$insert = mysqli_query($conn, $insertsql);
		
		if($insert){
			// Update classroom slot - Sum + 1z
			$updatesql = 'UPDATE Classroom
						 SET Slot = Slot + 1
						 WHERE ClassID = '.$classid.';';
			$update = mysqli_query($conn, $updatesql);
			if($update){
			mysqli_commit($conn);
			$msg =  ("<script LANGUAGE='JavaScript'>
					window.alert('Succesfully Registered!');
					window.location ='./svieworder.php';
					</script>");
			}else{
			mysqli_rollback($conn);
			$msg = '  <div class="alert alert-danger">
						<strong>Warning!</strong> Failed to update the classroom. Please contact admin!
					  </div>';
			}
		}else{
			mysqli_rollback($conn);
			$msg = '  <div class="alert alert-danger">
						<strong>Danger!</strong> Please Contact Admin! Something went wrong.
					  </div>';
		}
	}else{
		$msg = '<div class="alert alert-warning">
					<strong>Warning!</strong> Classroom is already full!
				</div>';
	}
	echo $msg;
}




// Student - Cancel classroom from orders table - Register Classroom
function cancelOrders($orderid){
	include 'dbConnect.php';
	// Turn off autocommit, in order to make every query run successfully
	// mysqli_autocommit($conn,FALSE);
	$message = '';
	// Delete selected record from class reservation
	$deletesql = "DELETE FROM Orders
				  WHERE OrderID = $orderid";
	$delete = mysqli_query($conn, $deletesql);
	if($delete){
		
				mysqli_commit($conn);
				$message =  ("<script LANGUAGE='JavaScript'>
						window.alert('Succesfully Deleted Request');
						window.location ='svieworder.php';
						</script>");
						
			}else {
				$mesaage = '  <div class="alert alert-danger">
							<strong>Danger!</strong> Please Contact Admin! Something went wrong.
						</div>';
			}
				echo $message;
	}

	



// Get Class Reservation from Database * STUDENT VIEW TIMETABLE
function getReservation($studentid){
include 'dbConnect.php';
$sql= "SELECT Student.SName, Course.CourseName, Course.Session, Course.Hours, Classroom.Location, Classroom.StartTime, Classroom.EndTime, Classroom.ClassDate, CRDate 
FROM ClassReservation
INNER JOIN Student ON ClassReservation.SID = Student.SID
INNER JOIN Classroom ON ClassReservation.ClassID = Classroom.ClassID
INNER JOIN Course ON ClassReservation.CourseID = Course.CourseID
WHERE ClassReservation.SID = '.$studentid.' And Classroom.ClassDate >= DATE_FORMAT(CURDATE(), '%m/%d/%Y');";
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		$view = '<table id="scheduleTable" class="table table-striped custab">
				<thead>
					<tr>
						<th>Student Name</th>
						<th>Course Name</th>
						<th>Session</th>
						<th>Hours</th>
						<th>Location</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Class Date</th>
					</tr>
				</thead><tbody>';


		while($row = mysqli_fetch_assoc($result))
		{
		$view.= '<tr>
                <td>'.$row['SName'].'</td>
                <td>'.$row['CourseName'].'</td>
				<td>'.$row['Session'].'</td>
				<td>'.$row['Hours'].'</td>
				<td>'.$row['Location'].'</td>
				<td>'.$row['StartTime'].'</td>
				<td>'.$row['EndTime'].'</td>
				<td>'.$row['CRDate'].'</td>
            </tr>';
		}
		$view.= '</tbody></table>';
	}else{
		$view = '<div class="alert alert-danger">
				  Not yet register class!
				</div>';
	}
}else{
	$view = 'Database Connection Error.';
}
	return $view;
}

// Student - view orders 
function getOrdersStudent($sid){
include 'dbConnect.php';
$todayDate = date("m/d/Y");
$sql= 'SELECT OrderID, Classroom.ClassID, Student.SName, Course.CourseName, OrderDate, Classroom.ClassDate
FROM Orders
INNER JOIN Student ON Orders.SID = Student.SID
INNER JOIN Classroom ON Orders.ClassID = Classroom.ClassID
INNER JOIN Course ON Orders.CourseID = Course.CourseID
WHERE Orders.SID = '.$sid.' And Classroom.ClassDate >= DATE_FORMAT(CURDATE(), "%m/%d/%Y")
ORDER BY Orders.OrderDate DESC;';
$result = mysqli_query($conn, $sql);
	if(isset($result)){
		$view = '<table id="orderTable" class="table table-striped custab">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>Student Name</th>
						<th>Course Name</th>
						<th>Class Date</th>
						<th>OrderDate</th>
						<th>Action</th>
					</tr>
				</thead><tbody>';

		while($row = mysqli_fetch_assoc($result))
		{
		$dt = strtotime($row['OrderDate']);
		$day = date("l", $dt);
		$view.= '<tr>
				<td>'.$row['OrderID'].'</td>
                <td>'.$row['SName'].'</td>
				<td>'.$row['CourseName'].'</td>
				<td>'.$row['ClassDate'].'</td>
				<td>'.$row['OrderDate'].' / ('.$day.')</td>
				<td>
				
				<a href="svieworder.php?oid='.$row['OrderID'].'" class="btn btn-danger">cancel</a>
				
				<td>';
		
		$view.=	'</td>
            </tr>';
		}
		$view.= '</tbody></table>';
	}else{
	$view = 'Database Connection Error.';
}
	return $view;
}


// Get Course from Database - Lecturer
function getCourseLecturer($lecturerid,$start_from,$per_page){
include 'dbConnect.php';
$sql= 'SELECT * FROM course WHERE LID = '.$lecturerid.' LIMIT '.$start_from.','.$per_page.';';
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		echo '<div id="products" class="row list-group">';
		while($row = mysqli_fetch_assoc($result)){	
			echo '<div class="item  col-xs-4 col-lg-4">
				<div class="thumbnail">
					<img class="group list-group-image" src="http://placehold.it/400x250/000/fff&text='.$row["CourseName"].'" />
					<div class="caption">
						<h4 class="group inner list-group-item-heading">
							'.$row["CourseName"].'</h4>
						<p class="group inner list-group-item-text">
							'.$row["CourseDesc"].'</p>
						<div class="row">
							<div class="col-xs-12 col-md-6">
							<form method="post" action="classroom.php">
							<div><input type="hidden" name="course_id" value="'.$row["CourseID"].'"/></div>
							<input class="btn btn-success" type="submit" name="view" value="View Sessions"/>
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>';
			}
			echo '</div>';
			
			//Now select all from table
			$querypage = 'SELECT * FROM Course WHERE LID = '.$lecturerid.';';

			$resultpage = mysqli_query($conn, $querypage);

			// Count the total records
			$total_records = mysqli_num_rows($resultpage);

			//Using ceil function to divide the total records on per page
			$total_pages = ceil($total_records / $per_page);
			
			//first page
			echo "<ul class='pagination'>
				 <li class='page-item'><a href='course.php?page=1'>".'<<'."</a></li>";

			for ($i=1; $i<=$total_pages; $i++) {

			echo "<li class='page-item'><a href='course.php?page=".$i."'>".$i."</a></li>";
			};
			// last page
			echo "<li class='page-item'><a href='course.php?page=$total_pages'>".'>>'."</a></li>
				</ul>";
		}
	}else{
		echo 'Error Database!';
	}
}

// Get Classroom from Database - Lecturer
function getClassLecturer($courseid){
include 'dbConnect.php';
$sql= 'SELECT ClassID, Course.CourseID, Course.CourseName, Slot, Capacity, Course.Session, Course.Hours, Location, StartTime, EndTime, ClassDate 
FROM Classroom
INNER JOIN Course ON Classroom.CourseID = Course.CourseID
WHERE Classroom.CourseID = '.$courseid.' And Classroom.ClassDate >= DATE_FORMAT(DATE_SUB(NOW(), INTERVAL 7 DAY), "%m/%d/%Y");';
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		$view = '<table id="classroomTable" class="table table-striped custab">
				<thead>
					<tr>
						<th>Classroom ID</th>
						<th>Course Name</th>
						<th>Capacity</th>
						<th>Day/s</th>
						<th>Hours</th>
						<th>Location</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Class Date</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>';


		while($row = mysqli_fetch_assoc($result))
		{
		$view.= '<tr>
                <td>'.$row['ClassID'].'</td>
                <td>'.$row['CourseName'].'</td>
				<td>'.$row['Slot'].' / '.$row['Capacity'].'</td>
				<td>'.$row['Session'].'</td>
				<td>'.$row['Hours'].'</td>
				<td>'.$row['Location'].'</td>
				<td>'.$row['StartTime'].'</td>
				<td>'.$row['EndTime'].'</td>
				<td>'.$row['ClassDate'].'</td>
				<td>
				
				<a href="attendance.php?cid='.$row['CourseID'].'&cdte='.$row['ClassDate'].'"><input class="btn btn-success view_data" type="button" name="view" id="'.$row['ClassID'].'" value="Student List"/></a>
				</td>
            </tr>';
		}
		$view.= '</tbody></table>';
	}else{
		$view = '<div class="alert alert-danger">
				  No Class Available!
				</div>';
	}
}else{$view = 'Database Connection Error.';
}
	return $view;
}



// Lecturer - Get Reservation from database - For lecturer to view student list and make attendance record
function getReservationLecturer($classid,$crdate){
include 'dbConnect.php';
$sql= "SELECT Student.SID, Classroom.ClassID, Course.CourseID, Student.SName, Course.CourseName, Classroom.Location, Classroom.StartTime, Classroom.EndTime, CRDate 
FROM ClassReservation
INNER JOIN Student ON ClassReservation.SID = Student.SID
INNER JOIN Classroom ON ClassReservation.ClassID = Classroom.ClassID
INNER JOIN Course ON ClassReservation.CourseID = Course.CourseID
WHERE Classroom.ClassID = '.$classid.'
AND CRDate = '.$crdate.'";
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		$view = '<form method="post" action="attendance.php">
				<table id="studentListTable" class="table table-striped custab">
				<thead>
					<tr>
						<td>Student Name</td>
						<td>Course Name</td>
						<td>Location</td>
						<td>Start Time</td>
						<td>End Time</td>
						<td>Class Date</td>
						</tr>
				</thead><tbody>';

		$count = 0;
		while($row = mysqli_fetch_assoc($result))
		{
		$dt = strtotime($row['CRDate']);
		$day = date("l", $dt);
		
		$view.= '<tr>
                <td>'.$row['SName'].'</td>
                <td>'.$row['CourseName'].'</td>
				<td>'.$row['Location'].'</td>
				<td>'.$row['StartTime'].'</td>
				<td>'.$row['EndTime'].'</td>
				<td>'.$row['CRDate'].' / ('.$day.')</td>
				<td>
				
				</td>
				</tr>
				';
		$count++;
		}
		
	}else{
		$view = '<div class="alert alert-danger">
				  No student register this class yet!
				</div>';
	}
}else{
	$view = 'Database Connection Error.';
}
	return $view;
}

// Admin - Add Course
function insertCourse($coursename,$coursedesc,$lecturer,$session,$hour){
	include 'dbConnect.php';
	// To validate whether the course name is duplicate or not
	$sql = 'SELECT * FROM Course
			WHERE CourseName = "'.$coursename.'";';
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result)>0){
		$msg = '  <div class="alert alert-danger">
			<strong>Danger!</strong> This course name already added!
		  </div>';
	}else{
		$insertsql = 'INSERT INTO Course (CourseName, CourseDesc, LID, Session, Hours) 
		VALUES ("'.$coursename.'", "'.$coursedesc.'", '.$lecturer.', "'.$session.'", "'.$hour.'")';
		$insert = mysqli_query($conn, $insertsql);
		
		if($insert){

			$msg =  ("<script LANGUAGE='JavaScript'>
					window.alert('Course successfully added!');
					window.location ='./viewCourse.php';
					</script>");
		}else{
			$msg = '  <div class="alert alert-danger">
						<strong>Danger!</strong> Please Contact Admin! Something went wrong.
					  </div>';
		}
	}
	
	mysqli_close($conn);
	
	echo $msg;
}

// Admin - Edit Course
function editCourse($courseid,$coursename,$coursedesc,$lecturer,$session,$hour){
	include 'dbConnect.php';
	
	$updatesql = 'UPDATE Course 
				SET CourseName = "'.$coursename.'", CourseDesc = "'.$coursedesc.'", LID = '.$lecturer.', Session = "'.$session.'", Hours = "'.$hour.'"
				WHERE CourseID = '.$courseid.';';
	$update = mysqli_query($conn, $updatesql);

	if($update){

		$msg =  ' <div class="alert alert-success">
					<strong>Success!</strong> Successfully Edited.
				  </div>';
	}else{
		$msg = '  <div class="alert alert-danger">
					<strong>Danger!</strong> Please Contact Admin! Something went wrong.
				  </div>';
	}
	
	mysqli_close($conn);
	
	echo $msg;
}

// Admin - Delete Course
function deleteCourse($courseid){
	include 'dbConnect.php';
	// Delete Course
	$deletesql = 'DELETE FROM Course
			WHERE CourseID = '.$courseid.';';
	$delete = mysqli_query($conn, $deletesql);
	
		if($delete){

			$msg =  ' <div class="alert alert-success">
						<strong>Success!</strong> You have successfully delete!
					  </div>';
					  
		}else{
			$msg = '  <div class="alert alert-danger">
						<strong>Danger!</strong> Please Contact Admin! Something went wrong.
					  </div>';
		}
		
	echo $msg;
}


// Admin - View Course
function getCourseAdmin(){
include 'dbConnect.php';
$sql= 'SELECT CourseID, CourseName, Lecturer.LName, CourseDesc, Session, Hours
FROM Course
INNER JOIN Lecturer ON Course.LID = Lecturer.LID;';
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		$view = '<table id="courseTable" class="table">
				<thead>
					<tr>
						<th>Course ID</th>
						<th>Course Name</th>
						<th>Lecturer</th>
						<th>Course Desc</th>
						<th>Session</th>
						<th>Hours</th>
						<th>Action</th>
					</tr>
				</thead><tbody>';


		while($row = mysqli_fetch_assoc($result))
		{
		$view.= '<tr>
                <td>'.$row['CourseID'].'</td>
                <td>'.$row['CourseName'].'</td>
				<td>'.$row['LName'].'</td>
				<td>'.$row['CourseDesc'].'</td>
				<td>'.$row['Session'].'</td>
				<td>'.$row['Hours'].'</td>
                <td>
				<form method="post" action="editCourse.php" class="form-inline pull-left">
				<div><input type="hidden" name="courseid" value="'.$row["CourseID"].'"/></div>
				<input class="btn btn-info" type="submit" name="edit" value="Edit"/>
				</form>
				<form method="post" action="viewCourse.php" class="form-inline pull-left">
				<div><input type="hidden" name="courseid" value="'.$row["CourseID"].'"/></div>
				<input class="btn btn-danger" type="submit" name="delete" value="Delete"/>
				</form>
				</td>
				</tr>';
		}
		$view.= '</tbody></table>';
	}else{
		$view = '<div class="alert alert-danger">
				  No Class Available!
				</div>';
	}
}else{$view = 'Database Connection Error.';
}
	return $view;
}

// Admin - Add Classroom
function insertClassroom($courseid,$capacity,$location,$starttime,$endtime,$classdate){
	include 'dbConnect.php';
	// To validate whether the classroom is full or not
	$sql = 'SELECT * FROM Classroom
			WHERE CourseID = "'.$courseid.'" AND ClassDate = "'.$classdate.'";';
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)>0){
		$msg = '  <div class="alert alert-danger">
			<strong>Danger!</strong> This course and class date already added!
		  </div>';
	}else{
		$insertsql = 'INSERT INTO Classroom (CourseID, Slot, Capacity, Location, StartTime, EndTime, ClassDate) 
		VALUES ("'.$courseid.'", "0", "'.$capacity.'", "'.$location.'", "'.$starttime.'", "'.$endtime.'", "'.$classdate.'")';
		$insert = mysqli_query($conn, $insertsql);
		
		if($insert){

			$msg =  ("<script LANGUAGE='JavaScript'>
					window.alert('Classroom successfully added!');
					window.location ='./viewClass.php';
					</script>");
		}else{
			$msg = '  <div class="alert alert-danger">
						<strong>Danger!</strong> Please Contact Admin! Something went wrong.
					  </div>';
		}
	}		
	echo $msg;
}


// Admin - Edit Classroom
function editClassroom($classid,$courseid,$capacity,$location,$starttime,$endtime,$classdate){
	include 'dbConnect.php';
	
	$updatesql = 'UPDATE Classroom 
				SET CourseID = "'.$courseid.'", Capacity = "'.$capacity.'", Location = "'.$location.'", StartTime = "'.$starttime.'", EndTime = "'.$endtime.'", ClassDate = "'.$classdate.'"
				WHERE ClassID = '.$classid.';';
	$update = mysqli_query($conn, $updatesql);
	
	if($update){

		$msg =  ' <div class="alert alert-success">
					<strong>Success!</strong> Successfully Edited.
				  </div>';
	}else{
		$msg = '  <div class="alert alert-danger">
					<strong>Danger!</strong> Please Contact Admin! Something went wrong.
				  </div>';
	}
	echo $msg;
}

// Admin - Delete Classroom
function deleteClassroom($classid){
	include 'dbConnect.php';
	// To validate whether the classroom is full or not
	$deletesql = 'DELETE FROM Classroom
			WHERE ClassID = '.$classid.';';
	$delete = mysqli_query($conn, $deletesql);
	
		if($delete){

			$msg =  '  <div class="alert alert-success">
						<strong>Success!</strong> You have successfully delete!
					  </div>';
					  
		}else{
			$msg = '  <div class="alert alert-danger">
						<strong>Danger!</strong> Please Contact Admin! Something went wrong.
					  </div>';
		}
		
	echo $msg;
}

// Admin - View Classroom
function getClassAdmin(){
include 'dbConnect.php';
$sql= 'SELECT ClassID, Course.CourseID, Course.CourseName, Slot, Capacity, Course.Session, Course.Hours, Location, StartTime, EndTime, ClassDate 
FROM Classroom
INNER JOIN Course ON Classroom.CourseID = Course.CourseID
WHERE ClassDate >= DATE_FORMAT(CURDATE(), "%m/%d/%Y")
ORDER BY Classroom.ClassDate DESC';
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		$view = '<table id="classroomTable" class="table">
				<thead>
					<tr>
						<th>Classroom ID</th>
						<th>Course Name</th>
						<th>Capacity</th>
						<th>Location</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Class Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';


		while($row = mysqli_fetch_assoc($result))
		{
		$view.= '<tr>
                <td>'.$row['ClassID'].'</td>
                <td>'.$row['CourseName'].'</td>
				<td>'.$row['Slot'].' / '.$row['Capacity'].'</td>
				<td>'.$row['Location'].'</td>
				<td>'.$row['StartTime'].'</td>
				<td>'.$row['EndTime'].'</td>
				<td>'.$row['ClassDate'].'</td>
                <td>
				<form method="post" action="editClass.php" class="form-inline pull-left" >
				<div><input type="hidden" name="classid" value="'.$row["ClassID"].'" /></div>
				<input class="btn btn-info" type="submit" name="edit" value="Edit"/>
				</form>
				<form method="post" action="viewClass.php" class="form-inline pull-left" >
				<div><input type="hidden" name="classid" value="'.$row["ClassID"].'"/></div>
				<input class="btn btn-danger" type="submit" name="delete" value="Delete" />
				</form>
				</td>
				</tr>';
		}
		$view.= '</tbody></table>';
	}else{
		$view = '<div class="alert alert-danger">
				  No Class Available!
				</div>';
	}
}else{$view = 'Database Connection Error.';
}
	return $view;
}

// Admin - View Expired Classroom
function getExpiredClassAdmin(){
include 'dbConnect.php';
$sql= 'SELECT ClassID, Course.CourseID, Course.CourseName, Slot, Capacity, Course.Session, Course.Hours, Location, StartTime, EndTime, ClassDate 
FROM Classroom
INNER JOIN Course ON Classroom.CourseID = Course.CourseID
WHERE ClassDate <= DATE_FORMAT(CURDATE(), "%m/%d/%Y")
ORDER BY Classroom.ClassDate DESC';
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		$view = '<table id="classroomTable" class="table">
				<thead>
					<tr>
						<th>Classroom ID</th>
						<th>Course Name</th>
						<th>Capacity</th>
						<th>Location</th>
						<th>Start Time</th>
						<th>End Time</th>
						<th>Class Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>';


		while($row = mysqli_fetch_assoc($result))
		{
		$view.= '<tr>
                <td>'.$row['ClassID'].'</td>
                <td>'.$row['CourseName'].'</td>
				<td>'.$row['Slot'].' / '.$row['Capacity'].'</td>
				<td>'.$row['Location'].'</td>
				<td>'.$row['StartTime'].'</td>
				<td>'.$row['EndTime'].'</td>
				<td>'.$row['ClassDate'].'</td>
                <td>
				<form method="post" action="viewExpiredClass.php">
				<div><input type="hidden" name="classid" value="'.$row["ClassID"].'"/></div>
				<input class="btn btn-danger" type="submit" name="delete" value="Delete" />
				</form>
				</td>
				</tr>';
		}
		$view.= '</tbody></table>';
	}else{
		$view = '<div class="alert alert-danger">
				  No Class Available!
				</div>';
	}
}else{$view = 'Database Connection Error.';
}
	return $view;
}

// Admin - Add Admin
 function insertAdmin($aname,$ausername,$apassword){
	include 'dbConnect.php';
	$insertsql = 'INSERT INTO Admin (AName, AUsername, APassword) 
	VALUES ("'.$aname.'", "'.$ausername.'", "'.$apassword.'")';
	$insert = mysqli_query($conn, $insertsql);

	if($insert){
		$msg =  ("<script LANGUAGE='JavaScript'>
				window.alert('Admin successfully added!');
				window.location ='./index.php';
				</script>");
	}else{
		$msg = '  <div class="alert alert-danger">
					<strong>Danger!</strong> Please Contact Admin! Something went wrong.
				  </div>';
	}	
	echo $msg;
}

// Admin - Add Lecturer
 function insertLecturer($lname,$lusername,$lpw){
	include 'dbConnect.php';
	$insertsql = 'INSERT INTO Lecturer (LName, LUsername, LPassword) 
	VALUES ("'.$lname.'", "'.$lusername.'", "'.$lpw.'")';
	$insert = mysqli_query($conn, $insertsql);

	if($insert){

		$msg =  ("<script LANGUAGE='JavaScript'>
				window.alert('Lecturer successfully added!');
				window.location ='./viewLecturer.php';
				</script>");
	}else{
		$msg = '  <div class="alert alert-danger">
					<strong>Danger!</strong> Please Contact Admin! Something went wrong.
				  </div>';
	}	
	echo $msg;
}

// Admin - Edit Student
 function editStudent($sid,$sname,$susername,$spw){
	include 'dbConnect.php';

	$updatesql = 'UPDATE Student 
				SET SName = "'.$sname.'", SUsername = "'.$susername.'", SPassword = "'.$spw.'"
				WHERE SID = '.$sid.';';
	$update = mysqli_query($conn, $updatesql);
	
	if($update){

		$msg =  ' <div class="alert alert-success">
					<strong>Success!</strong> Successfully Edited.
				  </div>';
	}else{
		$msg = '  <div class="alert alert-danger">
					<strong>Danger!</strong> Please Contact Admin! Something went wrong.
				  </div>';
	}	
	echo $msg;
}

// Admin - Delete Student
function deleteStudent($sid){
	include 'dbConnect.php';
	$deletesql = 'DELETE FROM Student
			WHERE SID = '.$sid.';';
	$delete = mysqli_query($conn, $deletesql);
	
		if($delete){

			$msg =  '  <div class="alert alert-success">
						<strong>Success!</strong> You have successfully delete!
					  </div>';
					  
		}else{
			$msg = '  <div class="alert alert-danger">
						<strong>Danger!</strong> Please Contact Admin! Something went wrong.
					  </div>';
		}
		
	echo $msg;
}

// Admin - View Student
function getStudentAdmin(){
include 'dbConnect.php';
$sql= 'SELECT * FROM Student;';
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		$view = '<table id="studentTable" class="table">
				<thead>
					<tr>
						<th>Student ID</th>
						<th>Student Name</th>
						<th>Student Username</th>
						<th>Student Password</th>
						<th>Action</th>
					</tr>
				</thead><tbody>';


		while($row = mysqli_fetch_assoc($result))
		{
		$view.= '<tr>
                <td>'.$row['SID'].'</td>
                <td>'.$row['SName'].'</td>
				<td>'.$row['SUsername'].'</td>
				<td>'.$row['SPassword'].'</td>
                <td>
				<form method="post" action="editStudent.php" class="form-inline pull-left">
				<div><input type="hidden" name="sid" value="'.$row["SID"].'"/></div>
				<input class="btn btn-info" type="submit" name="edit" value="Edit"/>
				</form>
				<form method="post" action="viewStudent.php" class="form-inline pull-left">
				<div><input type="hidden" name="sid" value="'.$row["SID"].'"/></div>
				<input class="btn btn-danger" type="submit" name="delete" value="Delete"/>
				</form>
				</td>
				</tr>';
		}
		$view.= '</tbody></table>';
	}else{
		$view = '<div class="alert alert-danger">
				  No Student!
				</div>';
	}
}else{$view = 'Database Connection Error.';
}
	return $view;
}

// Admin - Edit Lecturer
 function editLecturer($lid,$lname,$lusername,$lpw){
	include 'dbConnect.php';

	$updatesql = 'UPDATE Lecturer 
				SET LName = "'.$lname.'", LUsername = "'.$lusername.'", LPassword = "'.$lpw.'"
				WHERE LID = '.$lid.';';
	$update = mysqli_query($conn, $updatesql);
	
	if($update){

		$msg =  ' <div class="alert alert-success">
					<strong>Success!</strong> Successfully Edited.
				  </div>';
	}else{
		$msg = '  <div class="alert alert-danger">
					<strong>Danger!</strong> Please Contact Admin! Something went wrong.
				  </div>';
	}	
	echo $msg;
}

// Admin - Delete Lecturer
function deleteLecturer($lid){
	include 'dbConnect.php';
	$deletesql = 'DELETE FROM Lecturer
			WHERE LID = '.$lid.';';
	$delete = mysqli_query($conn, $deletesql);
	
		if($delete){

			$msg =  '  <div class="alert alert-success">
						<strong>Success!</strong> You have successfully delete!
					  </div>';
					  
		}else{
			$msg = '  <div class="alert alert-warning">
						<strong>Warning!</strong> This lecturer still handling some courses. Therefore, it cannot be delete.
					  </div>';
		}
		
	echo $msg;
}

// Admin - View Lecturer
function getLecturerAdmin(){
include 'dbConnect.php';
$sql= 'SELECT * FROM Lecturer;';
$result = mysqli_query($conn, $sql);
if(isset($result)){
	if(mysqli_num_rows($result) > 0){
		$view = '<table id="lecturerTable" class="table">
				<thead>
					<tr>
						<th>Lecturer ID</th>
						<th>Lecturer Name</th>
						<th>Lecturer Username</th>
						<th>Lecturer Password</th>
						<th>Action</th>
					</tr>
				</thead><tbody>';


		while($row = mysqli_fetch_assoc($result))
		{
		$view.= '<tr>
                <td>'.$row['LID'].'</td>
                <td>'.$row['LName'].'</td>
				<td>'.$row['LUsername'].'</td>
				<td>'.$row['LPassword'].'</td>
                <td>
				<form method="post" action="editLecturer.php" class="form-inline pull-left">
				<div><input type="hidden" name="lid" value="'.$row["LID"].'"/></div>
				<input class="btn btn-info" type="submit" name="edit" value="Edit"/>
				</form>
				<form method="post" action="viewLecturer.php" class="form-inline pull-left">
				<div><input type="hidden" name="lid" value="'.$row["LID"].'"/></div>
				<input class="btn btn-danger" type="submit" name="delete" value="Delete"/>
				</form>
				</td>
				</tr>';
		}
		$view.= '</tbody></table>';
	}else{
		$view = '<div class="alert alert-danger">
				  No Lecturer!
				</div>';
	}
}else{$view = 'Database Connection Error.';
}
	return $view;
}

// Admin - view orders 
function getOrdersAdmin(){
include 'dbConnect.php';
$todayDate = date("m/d/Y");
$sql= 'SELECT OrderID, Student.SUsername, Student.SName, Course.CourseName, OrderDate, Classroom.ClassDate
FROM Orders
INNER JOIN Student ON Orders.SID = Student.SID
INNER JOIN Classroom ON Orders.ClassID = Classroom.ClassID
INNER JOIN Course ON Orders.CourseID = Course.CourseID
WHERE Classroom.ClassDate >= DATE_FORMAT(CURDATE(), "%m/%d/%Y")
ORDER BY Orders.OrderDate DESC';
$result = mysqli_query($conn, $sql);
	if(isset($result)){
		$view = '<table id="orderTable" class="table">
				<thead>
					<tr>
						<th>Student Username</th>
						<th>Student Name</th>
						<th>Course Name</th>
						<th>Class Date</th>
						<th>Order Date</th>
						<th>Action</th>
					</tr>
				</thead><tbody>';

		while($row = mysqli_fetch_assoc($result))
		{
		$dt = strtotime($row['OrderDate']);
		$day = date("l", $dt);
		$view.= '<tr>
				<td>'.$row['SUsername'].'</td>
                <td>'.$row['SName'].'</td>
                <td>'.$row['CourseName'].'</td>
				<td>'.$row['ClassDate'].'</td>
				<td>'.$row['OrderDate'].' / ('.$day.')</td>
				<td>
				<form method="post" action="editorder.php">
				<div><input type="hidden" name="order_id" value="'.$row["OrderID"].'"/></div>
				<input class="btn btn-success edit_data" type="submit" name="view" value="View Order"/>
				</form>
				</td>
            </tr>';
		}
		$view.= '</tbody></table>';
	}else{
	$view = 'Database Connection Error.';
}
	return $view;
}

// Admin - view expired orders 
function getExpiredOrdersAdmin(){
include 'dbConnect.php';
$todayDate = date("m/d/Y");
$sql= 'SELECT OrderID, Student.SUsername, Student.SName, Course.CourseName, OrderDate, Classroom.ClassDate
FROM Orders
INNER JOIN Student ON Orders.SID = Student.SID
INNER JOIN Classroom ON Orders.ClassID = Classroom.ClassID
INNER JOIN Course ON Orders.CourseID = Course.CourseID
WHERE Classroom.ClassDate <= DATE_FORMAT(CURDATE(), "%m/%d/%Y")
ORDER BY Orders.OrderDate DESC';
$result = mysqli_query($conn, $sql);
	if(isset($result)){
		$view = '<table id="orderTable" class="table">
				<thead>
					<tr>
						<th>Student Username</th>
						<th>Student Name</th>
						<th>Course Name</th>
						<th>Class Date</th>
						<th>Order Date</th>
						<th>Action</th>
					</tr>
				</thead><tbody>';

		while($row = mysqli_fetch_assoc($result))
		{
		$dt = strtotime($row['OrderDate']);
		$day = date("l", $dt);
		$view.= '<tr>
				<td>'.$row['SUsername'].'</td>
                <td>'.$row['SName'].'</td>
                <td>'.$row['CourseName'].'</td>
				<td>'.$row['ClassDate'].'</td>
				<td>'.$row['OrderDate'].' / ('.$day.')</td>
				<td>
				<form method="post" action="viewExpiredOrder.php">
				<div><input type="hidden" name="order_id" value="'.$row["OrderID"].'"/></div>
				<input class="btn btn-danger" type="submit" name="delete" value="Delete"/>
				</form>
				</td>
            </tr>';
		}
		$view.= '</tbody></table>';
	}else{
	$view = 'Database Connection Error.';
}
	return $view;
}

// Admin - Delete Expired Order
function deleteOrder($oid){
	include 'dbConnect.php';
	$deletesql = 'DELETE FROM Orders
			WHERE OrderID = '.$oid.';';
	$delete = mysqli_query($conn, $deletesql);
	
		if($delete){

			$msg =  '  <div class="alert alert-success">
						<strong>Success!</strong> You have successfully delete!
					  </div>';
					  
		}else{
			$msg = '  <div class="alert alert-danger">
						<strong>Danger!</strong> Please Contact Admin! Something went wrong.
					  </div>';
		}
		
	echo $msg;
}


