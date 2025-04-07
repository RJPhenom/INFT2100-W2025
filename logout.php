<?php
/**
* This is the logout page for my INFT2100 site.
*
*
* PHP version 8.1
*
* @author RJ Macklem <robert.macklem@dcmail.ca>
* @version 1.0 (April 5, 2025)
*/

$file = "logout.php";
$description = "Logout page for my INFT2100 Site.";
$date = "April 5, 2025";
$banner = "Students Grade Portal"; 

// Header
include("./includes/header.php");
?>

<?php
// ----------LAB 4------------
// Log (in my functions.php)
log_activity("Logout: ".$_SESSION["user_id"]);

session_unset();
session_destroy();
session_start();

// place msg
$_SESSION['message'] = "You have successfully logged out.";
header("Location: ./login.php");
ob_flush();
// ----------------------------
?>
