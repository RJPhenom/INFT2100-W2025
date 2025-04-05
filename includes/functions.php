<?php
/**
* Provides globally accessible functions for the website
* via header.php include for database connection and 
* retrieval. 
*
* PHP version 8.1
*
* @author RJ Macklem <robert.macklem@dcmail.ca>
* @version 1.0 (March 13, 2025)
*/

// CONSTS
$NO_STUDENT_PROVIDED = "<p class='mt-5'>ERROR: No Student ID provided!</>";
$NO_STUDENT_FOUND = "<p class='mt-5'>ERROR: Student does not exist!</>";
$NO_MARKS_FOUND = "<p class='mt-5'>Student ID Found: No recorded marks received.</>";

// FUNCS
/**
 * Connects to the database
 * 
 * @return Database the database connection.
 */
function db_connect()
{
    $db_connection = pg_connect("dbname=macklemr_db user=macklemr password=100955944") or die("Could not connect!");
    return $db_connection;

}

/**
 * Gets the student id from the URL using _GET
 * @return Student student, if found, otherwise an error string.
 */
function get_student_id()
{
    // Check if student id was passed via URL
    if (isset($_GET['studentid']) && ("" != ($_GET['studentid'])))
    {
        // Setup if true
        $student = $_GET['studentid'];
    }

    else 
    {
        return $GLOBALS['NO_STUDENT_PROVIDED'];
    }

    return $student;
}

/**
 * Checks the database if ther provided student exists in the database.
 * 
 * @param Database the database connection to query against.
 * @param Student the student to query.
 * 
 * @return Exists the resultant student record info, or error string if not extant.
 */
function student_exists($db_connection, $user_id)
{
    // Prepare and execute (copied docs here: https://www.php.net/manual/en/function.pg-prepare.php)
    // Check if student exists
    $exists = pg_prepare($db_connection, "exists", 
        'SELECT 
            users.first_name, 
            users.last_name, 
            students.program_code, 
            users.email 
        FROM 
            students, 
            users 
        WHERE 
            users.user_id = students.user_id 
            AND 
            students.user_id = $1'
        );

    $exists = pg_execute($db_connection, "exists", array($user_id));

    if (pg_num_rows($exists) === 0)
    {
        return $GLOBALS['NO_STUDENT_FOUND'];
    }

    return $exists;
}

/**
 * Retrieves all the recorded marks for the student provided in the database.
 * 
 * @param Database the database connection to query against.
 * @param Student the student to query marks for.
 * 
 * @return Marks the marks found, if any. Otherwise, string stating no records found.
 */
function retrieve_marks($db_connection, $student_id)
{
    $marks = pg_prepare($db_connection, "retrieve_marks", 
        'SELECT 
            courses.course_code, 
            courses.course_description, 
            marks.final_mark, 
            marks.achieved_at
        FROM 
            marks, 
            courses,
            students
        WHERE 
            courses.course_code = marks.course_code
            AND
            marks.student_id = students.student_id 
            AND
            students.user_id = $1');
    $marks = pg_execute($db_connection, "retrieve_marks", array($student_id));

    // If no rows, let user know
    if (pg_num_rows($marks) === 0)
    {
        $marks = $GLOBALS['NO_MARKS_FOUND'];
    }

    return $marks;
}
