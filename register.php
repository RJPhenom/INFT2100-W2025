<?php
/**
* This is the login page for my INFT2100 site.
*
*
* PHP version 8.1
*
* @author RJ Macklem <robert.macklem@dcmail.ca>
* @version 1.0 (April 5, 2025)
*/

$file = "login.php";
$description = "Login page for my INFT2100 Site.";
$date = "April 5, 2025";
$banner = "Students Grade Portal"; 

// Header
include("./includes/header.php");

// Debug
// log_activity("Debug: register page hit! | PHP Version: " . phpversion() . " | Error Log: " . print_r(error_get_last(), true));
?>

<?php
// ----------LAB 4------------
// Check for user logged in, if so redirect to login with msg
if (isset($_SESSION["user_id"]))
{
    $_SESSION['message'] = "You are already logged in and cannot login again.";
    header("Location: ./login.php");
    ob_flush();
}

// Declare vars in case not in post (need definition)
$first_name = "";
$last_name = "";
$email = "";
$birth_date = "";
$program_code = "";
$cpga = "";
$cpgm = "";
$password = "";
$confirm_password = "";

// Declare error msg container outside postmode scope
$error_message = "";

// ------------POST------------
// Check for postmode (check anything was posted)
$post_mode = isset($_POST["firstname"])
|| isset($_POST['last_name'])
|| isset($_POST['email'])
|| isset($_POST['birth_Date'])
|| isset($_POST['program_code'])
|| isset($_POST['password'])
|| isset($_POST['confirm_password']);

if ($post_mode)
{
    // Store vars
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $birth_date = trim($_POST["birth_date"]);
    $program_code = trim($_POST["program_code"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // determine state for radio buttons
    if ($program_code == "CPGA")
    {
        $cpga = "checked";    
    }

    else if ($program_code == "CPGM")
    {
        $cpgm = "checked";
    }

    // Validation
    // Validation funcs in functions.php
    $valid_first_name = is_valid_name_input($first_name);
    $valid_last_name = is_valid_name_input($last_name);
    $valid_email = is_valid_email_input($email);
    $valid_birth_date = is_valid_birth_date_input($birth_date);
    $valid_password = is_valid_password_input($password);

    // Check confirmation matches
    $passwords_match = ($password == $confirm_password);

    // Overall validation
    $valid = $valid_first_name && $valid_last_name && $valid_email && $valid_birth_date && $valid_password && $passwords_match;

    if ($valid) 
    {
        // Hash password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // We now need the db to insert the new user and their hashed password
        $database = db_connect();
        insert_new_registration($database, $first_name, $last_name, $email, $birth_date, $password, $program_code);

        // Grab user's new id
        $id = retrieve_latest_user($database);

        // Log (in myfunctions.php)
        log_activity("Registration: New user successfully registered with attributes: ".$id." | ".$first_name." | ".$last_name." | ".$email." | ".$birth_date." | ".$program_code);

        // Set msg & send to login page
        $_SESSION['message'] = "You have successfully registered. You may now login.";
        header("Location: ./login.php");
        ob_flush();
    }

    // If we got here, something is invalid. Start building the output/clearing vals
    if (!$valid_first_name) 
    {
        $error_message .= "The input \"".$first_name."\" is an invalid name input. Must be between 2 to 256 characters and not empty.<br>";

        // Reset val (not sticky)
        $first_name = "";
    }

    if (!$valid_last_name) 
    {
        $error_message .= "The input \"".$last_name."\" is an invalid name input. Must be between 2 to 256 characters and not empty.<br>";

        // Reset val (not sticky)
        $last_name = "";
    }

    if (!$valid_email) 
    {
        $error_message .= "The input \"".$email."\" is an invalid email input. Must be between 6 and 256 characters of form \"a@b.cd\" and not empty<br>";

        // Reset val (not sticky)
        $email = "";
    }

    if (!$valid_birth_date) 
    {
        $error_message .= "The input \"".$birth_date."\" is an invalid birth date input. Must be a validate date and not empty.<br>";

        // Reset val (not sticky)
        $birth_date = "";
    }

    if (!$valid_password) 
    {
        $error_message .= "Invalid password. Must be between 6 to 60 characters and not empty.<br>";
    }

    if (!$passwords_match) 
    {
        $error_message .= "Passwords do not match";
    }
}
// ----------------------------
?>

<!-- Body -->
    <div class="starter-template">
        <form action="./register.php" method="post">
            <div><p>First Name:</p><input type="text" name="first_name" <?php /* sticky */ echo "value=$first_name"?>></div>
            <div><p>Last Name:</p><input type="text" name="last_name" <?php /* sticky */ echo "value=$last_name"?>></div>
            <div><p>Email:</p><input type="text" name="email" <?php /* sticky */ echo "value=$email"?>></div>
            <div><p>Date of Birth:</p><input type="text" name="birth_date" <?php /* sticky */ echo "value=$birth_date"?>></div>
            <div><p>Program:</p><input type="radio" name="program_code" value="CPGA" <?php /* sticky */ echo "checked=$cpga"?>> CPGA</div>
            <div><input type="radio" name="program_code" value="CPGM" <?php /* sticky */ echo "checked=$cpgm"?>> CPGM</div><br>
            <div><p>Password:</p><input type="password" name="password"></div>
            <div><p>Confirm Password:</p><input type="password" name="confirm_password"></div>
            <br>
            <input type="submit" name="Submit" value="Register"/>
        </form>
        <?php
            if ($error_message != "") 
            {
                echo $error_message;
            }
        ?>
    </div>

<?php
// Footer
include("./includes/footer.php");
