<?php
/**
* Grades page displays the grades of the queried
* student.
*
*
* PHP version 8.1
*
* @author RJ Macklem <robert.macklem@dcmail.ca>
* @version 1.0 (March 13, 2025)
*/

$file = "grades.php";
$description = "Grades results page for my INFT2100 Site.";
$date = "March 13, 2025";
$banner = "Students Grade Portal"; 

// VARS
$table_built = FALSE;

// Header
include("./includes/header.php");

// Redirect to login page if student isnt signed in (check in the SESSION global)
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "You must log in to access your grades.";
    header("Location: login.php");
    ob_flush();
    exit();
}

// Already logged in message
$msg = isset($_SESSION['message'])?$_SESSION['message']:"";
$_SESSION['message'] = "";

?>

<!-- Body -->
<div class="starter-template text-center py-5">


<?php
// Build the body.
// First confirm we have a valid student
$student = get_session_student_id(); // changed to check what was POSTed to SESSION (wrote a new func for it)
if (!($student === $NO_STUDENT_PROVIDED))
{
    // Next confirm student exists
    // NOTE: we now need the database
    $database = db_connect();
    $exists = student_exists($database, $student);
    if(!($exists === $NO_STUDENT_FOUND))
    {
        // Set up our heading with student info (add margin: https://getbootstrap.com/docs/4.0/utilities/spacing/)
        // -----------------------------------------------------
        // LAB 4 EDTI: user SESSION not the results from $exists
        // -----------------------------------------------------
        $student_output = "<h1 class='mt-5'>".$_SESSION["first_name"]." "; 
        $student_output .= $_SESSION["last_name"]."</h1>"; 
        $student_output .= "<p class='mt-4'>Program: ".$_SESSION["program_code"]; 
        $student_output .= " | Email: ".$_SESSION["email"]."</p>"; 
        $student_output .= "<p class='mt-4'>Enrol Date: ".$_SESSION["created_at"]; 
        $student_output .= " | Last Access: ".$_SESSION["last_access"]."</p>"; 
        // -----------------------------------------------------

        echo $student_output;

        // Retrieve the marks
        $marks = retrieve_marks($database, $student);

        // Only build the table if there are records.
        if (!($marks === $NO_MARKS_FOUND))
        {
            $table_built = TRUE;
            $rows = pg_num_rows($marks);

            $marks_output = "<div class='table-responsive mt-5'>
                            <table class='table table-bordered table-striped table-hover'>\n\t
                                <thead><tr>
                                    <th>Course Code</th>
                                    <th>Course Description</th>
                                    <th>Final Mark</th>
                                    <th>Achieved At</th>
                                </tr></thead>\n
                                <tbody>\n";

            for ($i = 0; $i < $rows; $i++)
            {
                $marks_output .= "\n\t<tr>\n\t\t<td>".pg_fetch_result($marks, $i, "course_code")."</td>"; 
                $marks_output .= "\n\t\t<td>".pg_fetch_result($marks, $i, "course_description")."</td>"; 
                $marks_output .= "\n\t\t<td>".pg_fetch_result($marks, $i, "final_mark")."</td>"; 
                $marks_output .= "\n\t\t<td>".pg_fetch_result($marks, $i, "achieved_at")."</td>\n\t</tr>"; 
            }

            $marks_output .= "</tbody>\n</table>\n</div>";

            // Print the table
            echo $marks_output;
        }

        // Otherwise print no marks found
        else
        {
            echo $marks;
        }
    }

    // Otherwise print no student exists
    else
    {
        echo $exists;
    }
}

// Otherwise print no student provided
else
{
    echo $student;
}
?>

    <?php
        // Handles if they try to register when logged in
        if ($msg !== "") echo "</br><p class=\"text-danger\">$msg</p>";
    ?>

</div>

<?php
// Footer
include("./includes/footer.php");
