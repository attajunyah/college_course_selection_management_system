<?php
include 'include/header.php';

// If post is from vieworders page then run this function.
if(isset($_POST['order_id'])){
$sql= 'SELECT OrderID, Classroom.ClassID, Student.SID, Course.CourseID, Student.SName, Course.CourseName, Classroom.ClassDate
FROM Orders
INNER JOIN Student ON Orders.SID = Student.SID
INNER JOIN Classroom ON Orders.ClassID = Classroom.ClassID
INNER JOIN Course ON Orders.CourseID = Course.CourseID
WHERE OrderID = '.$_POST['order_id'].';';

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$orderid = $row['OrderID'];
$classid = $row['ClassID'];
$sid = $row['SID'];
$courseid = $row['CourseID'];
$crdate = $row['ClassDate'];
$studentname = $row['SName'];
$coursename = $row['CourseName'];
}

// If edit button is pressed then run this function
if(isset($_POST['editbutton'])){

$orderid = $_POST['orderid'];
$classid = $_POST['classid'];
$sid = $_POST['sid'];
$courseid = $_POST['courseid'];
$studentname = $_POST['hiddenstudentname'];
$coursename = $_POST['hiddencoursename'];
$crdate = $_POST['crdate'];


$msg = updateOrder($orderid,$classid,$courseid,$sid,$crdate);
}
?>
    
<div class="container">

<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Edit Order</legend>

<?php if(isset($msg)){echo $msg;} ?>
<!-- Text input-->
<input type="hidden" name="orderid" value="<?php echo $orderid ?>"/>
<input type="hidden" name="classid" value="<?php echo $classid ?>"/>
<input type="hidden" name="courseid" value="<?php echo $courseid ?>"/>
<input type="hidden" name="sid" value="<?php echo $sid ?>"/>
<input type="hidden" name="hiddenstudentname" value="<?php echo $studentname ?>"/>
<input type="hidden" name="hiddencoursename" value="<?php echo $coursename ?>"/>
<input type="hidden" name="crdate" value="<?php echo $crdate ?>"/>

<div class="form-group">
  <label class="col-md-4 control-label" for="studentname">Student Name</label>  
  <div class="col-md-4">
  <input id="studentname" name="studentname" type="text" value="<?php echo $studentname ?>" class="form-control input-md" disabled /> 
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Course Name</label>
  <div class="col-md-4">
  <input id="coursename" name="coursename" type="text" value="<?php echo $coursename ?>" class="form-control input-md" disabled /> 
  </div>
</div>

<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="button1idDDSA"></label>
  <div class="col-md-8">
    <button type="submit" id="editbutton" name="editbutton" class="btn btn-success">Edit</button>
    <button id="goback" type="button" name="goback" class="btn btn-danger" onClick="history.go(-1);">Back</button>
  </div>
</div>

</fieldset>
</form>
</div>

<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
	<script src="assets/js/bootstrap.min.js"></script> 
	
	 <footer id="footer">
<?php
include 'include/footer.php';
?>

