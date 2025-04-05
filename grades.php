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
?>

<!-- Body -->
<div class="starter-template text-center py-5">


<?php
// Build the body.
// First confirm we have a valid student
$student = get_student_id();
if (!($student === $NO_STUDENT_PROVIDED))
{
    // Next confirm student exists
    // NOTE: we now need the database
    $database = db_connect();
    $exists = student_exists($database, $student);
    if(!($exists === $NO_STUDENT_FOUND))
    {
        // Set up our heading with student info (add margin: https://getbootstrap.com/docs/4.0/utilities/spacing/)
        $student_output = "<h1 class='mt-5'>".pg_fetch_result($exists, 0, "first_name")." "; 
        $student_output .= pg_fetch_result($exists, 0, "last_name")."</h1>"; 
        $student_output .= "<p class='mt-4'>Program: ".pg_fetch_result($exists, 0, "program_code"); 
        $student_output .= " | Email: ".pg_fetch_result($exists, 0, "email")."</p>"; 

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

</div>

<?php
// Footer
include("./includes/footer.php");
