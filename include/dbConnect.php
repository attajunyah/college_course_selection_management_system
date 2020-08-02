<?php

$host = 'localhost';
$user = 'root';
$pw = '919185';
$dbn = 'project';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//establish db connection
$conn = mysqli_connect($host,$user,$pw,$dbn);
if (mysqli_connect_errno($conn)) {
	echo 'Something went wrong, failed connect to MYSQL: ' . mysqli_connect_error();
	exit();
}
?>