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
// ----------COOKIE------------
// Declare cookie holder
$stored_user =  "";

// Check for cookie
if (isset($_COOKIE["LOGIN_COOKIE"]))
{
    $stored_user = $_COOKIE["LOGIN_COOKIE"];
}

// ------------POST------------
// Check for postmode
$post_mode = isset($_POST["user_id"]);

// Error message container (if anything fails)
$error_message = "";

// Logout message
$msg = isset($_SESSION['message'])?$_SESSION['message']:"";
$_SESSION['message'] = "";


if ($post_mode)
{
    // We now need the db, and to trim the input. Also declare 
    // pwd verified in outer scope for readability and access
    $database = db_connect();
    $student = trim($_POST["user_id"]);
    $password = trim($_POST["password"]);

    // Check student id exists
    $exists = !(student_exists($database, $student) === $NO_STUDENT_FOUND);

    // If exists
    if ($exists) {
        //Get the password from db (in functions.php) and verify
        // if password is valid and if so run sesh and updates
        $stored_password = retrieve_password($database, $student);
        $verified = password_verify($password, $stored_password);

        if ($verified) {
            // Retrieve info from db
            $student_info = retrieve_student($database, $student);

            // set cookie
            setcookie("LOGIN_COOKIE", $student, time() + 60*60*24*30);

            // Set sesh
            $_SESSION["user_id"] = $student;
            $_SESSION["student_id"] = pg_fetch_result($student_info, 0, "student_id");
            $_SESSION["first_name"] = pg_fetch_result($student_info, 0, "users.first_name");
            $_SESSION["last_name"] = pg_fetch_result($student_info, 0, "users.last_name");
            $_SESSION["email"] = pg_fetch_result($student_info, 0, "users.email");
            $_SESSION["created_at"] = pg_fetch_result($student_info, 0, "users.created_at");
            $_SESSION["last_access"] = pg_fetch_result($student_info, 0, "users.last_access");
            $_SESSION["program_code"] = pg_fetch_result($student_info, 0, "students.program_code");

            // Update last access
            update_last_access($database, $student);

            
            // Log (in my functions.php)
            log("Login Attempt (SUCCESS): ".$_SESSION["user_id"]);

            // Redirect to grades page
            header("Location: ./grades.php");
        }

        else {
            $error_message = "Login unsuccessful: Invalid password.";
        
            // Log (in my functions.php)
            log("Login Attempt (FAILED): ".$_SESSION["user_id"]."Error reason: Invalid password");
        }
    }

    else {
        $error_message = "Login unsuccessful: Invalid Student ID.";
        
        // Log (in my functions.php)
        log("Login Attempt (FAILED): ".$_SESSION["user_id"]."Error reason: Invalid Student ID");
    }
}
// ----------------------------
?>

<!-- Body -->
    <div class="starter-template">
        <form action="./login.php" method="post">
            <div><p>Student ID:</p><input type="text" name="student_id" <?php /* input cookie value we grabbed */ echo "value=$stored_user"?>/></div>
            <div><p>Password:</p><input type="password" name="password" /></div>
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
