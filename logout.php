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

// I dont include header.php cuz we dont actually visit this page
// and there is no html needed.

// ----------LAB 4------------
session_unset();
session_destroy();
session_start();

// place msg
$_SESSION['message'] = "You have successfully logged out.";
header("Location: ./login.php");
ob_flush();
// ----------------------------
?>