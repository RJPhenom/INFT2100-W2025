<?php
/**
* Header file, providing site-wide header for 
* opening/top of page details.
*
*
* PHP version 8.1
*
* @author RJ Macklem <robert.macklem@dcmail.ca>
* @version 1.0 (March 13, 2025)
*/

// sesh/buffer start
session_start();
ob_start();

// require funcs (lab 3 code)
require("functions.php");
?>

<!--
Name: RJ Macklem
File: <?php echo $file . "\n"; ?>
Date: <?php echo $date . "\n"; ?>
Description: <?php echo $description . "\n"; ?>
-->

<!DOCTYPE html>
<html lang="en">
<head>
<title>INFT2100 - <?php echo $banner; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
 
    <!-- BS5 Starter framework: https://getbootstrap.com/docs/4.0/examples/starter-template/ -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
        <?php if (isset($_SESSION['user'])): ?>
            <li class="nav-item">
            <a class="nav-link" href="grades.php">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
            </li>
        <?php endif; ?>

    </ul>
    </div>
    </nav>
    
    <main class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
