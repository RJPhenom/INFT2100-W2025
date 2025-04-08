<?php
/**
* Stie homepage
* 
*
*
* PHP version 8.1
*
* @author RJ Macklem <robert.macklem@dcmail.ca>
* @version 1.0 (March 13, 2025)
*/

$file = "index.php";
$description = "Home page for my INFT2100 Website";
$date = "March 13, 2025";
$banner = "Students Grade Portal";

// Header
include("./includes/header.php");
log_activity("Debug: index page hit! | PHP Version: " . phpversion() . " | Error Log: " . print_r(error_get_last(), true));
?>

<!-- Body -->
    <div class="starter-template">
        <h1>Welcome to the Students Grades Portal</h1>
        <p class="lead">Here you can query students and their grades.</p>
    </div>

<?php
// Footer
include("./includes/footer.php");
