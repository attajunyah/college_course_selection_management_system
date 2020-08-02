<?php 
session_start();
if(!isset($_SESSION['username']))
{
header( 'Location: login.php' ); 
}
else
{

//session_unset();
unset($_SESSION["Aname"]);
unset($_SESSION["Ausername"]);
unset($_SESSION["Auserid"]);

// EMAIL VERIFICATION SESSION
unset($_SESSION["activation-username"]);
unset($_SESSION["email"]);
unset($_SESSION["activationcode"]);

// Destroy the session.
//session_destroy();

header( 'Location: login.php' );
}
?>