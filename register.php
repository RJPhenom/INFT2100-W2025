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
?>

<?php
// ----------LAB 4------------
// Check for user logged in, if so redirect to login with msg
if (isset($_SESSION["user_id"]))
{
    $_SESSION['message'] = "You are already logged in and cannot login again.";
    header("Location: ./login.php");
}

// Declare error msg container outside postmode scope
$error_message = "";

// ------------POST------------
// Check for postmode
$post_mode = isset($_POST["user_id"]);
if ($post_mode)
{
    // Store vars
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $birth_date = trim($_POST["birth_date"]);
    $program_code = trim($_POST["program_code"]);

    // determine state for radio buttons
    $cpga = "";
    $cpgm = "";

    if ($program_code == "CPGA")
    {
        $cpga = "checked";    
    }

    else
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
        insert_new_registration($database, $first_name, $last_name, $email, $birth_date, $program_code, $password);

        // Log (in myfunctions.php)
        log("Registration: New user successfully registered with attributes:".$first_name." | ".$last_name." | ".$email." | ".$birth_date." | ".$program_code);

        // Set msg & send to login page
        $_SESSION['message'] = "You have successfully registered. You may now login.";
        header("Location: ./login.php");
    }

    // If we got here, something is invalid. Start building the output/clearing vals
    if (!$valid_first_name) 
    {
        $error_message .= $first_name." is an invalid name input. Must be between 2 to 256 characters.<br>";

        // Reset val (not sticky)
        $first_name = "";
    }

    if (!$valid_last_name) 
    {
        $error_message .= $last_name." is an invalid name input. Must be between 2 to 256 characters.<br>";

        // Reset val (not sticky)
        $last_name = "";
    }

    if (!$valid_email) 
    {
        $error_message .= $first_name." is an invalid email input. Must be between 6 and 256 characters of form \"a@b.cd\"<br>";

        // Reset val (not sticky)
        $email = "";
    }

    if (!$valid_birth_date) 
    {
        $error_message .= $first_name." is an invalid birth date input. Must be a validate date and not empty.<br>";

        // Reset val (not sticky)
        $birth_date = "";
    }

    if (!$valid_password) 
    {
        $error_message .= "Invalid password. Must be between 6 to 60 characters.<br>";
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
            <div><p>First Name:</p><input type="text" name="first_name" <?php /* sticky */ echo "value=$first_name"?>/></div>
            <div><p>Last Name:</p><input type="text" name="last_name" <?php /* sticky */ echo "value=$last_name"?>/>/></div>
            <div><p>Email:</p><input type="text" name="email" <?php /* sticky */ echo "value=$email"?>/>/></div>
            <div><p>Date of Birth:</p><input type="text" name="birth_date" <?php /* sticky */ echo "value=$birth_date"?>/>/></div>
            <div><p>Program:</p><input type="radio" name="program_code" value="CPGA" <?php /* sticky */ echo "checked=$cpga"?>/>/>CPGA</div>
            <div><input type="radio" name="program_code" value="CPGM" <?php /* sticky */ echo "checked=$cpgm"?>/>/>CPGM</div>
            <div><p>Password:</p><input type="password" name="password" /></div>
            <div><p>Confirm Password:</p><input type="password" name="confirm_password" /></div>
            <br>
            <input type="submit" name="Submit" value="Login"/>
            <?php
                if ($msg !== "") echo "</br><p class=\"text-danger\">$msg</p>";
            ?>
            <?php
                if ($error_message !== "") echo "</br><p class=\"text-danger\">$error_message</p>";
            ?>
        </form>
    </div>

<?php
// Footer
include("./includes/footer.php");
