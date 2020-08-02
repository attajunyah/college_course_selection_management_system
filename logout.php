<?php 
session_start();
if(!isset($_SESSION['username']))
{
header( 'Location: login.php' ); 
}
else
{

//session_unset();
unset($_SESSION["username"]);
unset($_SESSION["userid"]);
unset($_SESSION["Luserid"]);



// Destroy the session.
//session_destroy();

header( 'Location: login.php' );
}
?>