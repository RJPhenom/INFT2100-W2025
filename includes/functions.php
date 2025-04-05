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

// Lab 4 CODE
// vvvvvvvvvv

/**
 * Retrieves all the information about a student.
 * 
 * @param Database the database connection to query against.
 * @param Student the student to query.
 * 
 * @return User the student found, if any.
 */
function retrieve_student($db_connection, $student_id)
{
    $student = pg_prepare($db_connection, "select_student", 
        'SELECT 
            *
        FROM 
            students, 
            users 
        WHERE 
            users.user_id = students.user_id 
            AND 
            students.user_id = $1'
        );

    $student = pg_execute($db_connection, "select_student", array($student_id));

    if (pg_num_rows($student) === 0)
    {
        return $GLOBALS['NO_STUDENT_FOUND'];
    }

    return $student;
}

/**
 * Updates information about a student.
 * 
 * @param Database the database connection to query against.
 * @param Student the student to update.
 * 
 * @return User the student found, if any.
 */
function update_last_access($db_connection, $user_id)
{
    $last_access = pg_prepare($db_connection, "update_last_access", 
        'UPDATE 
            users
        SET
            last_access = CURRENT_TIMESTAMP
        WHERE 
            users.user_id = $1'
        );

    $last_access = pg_execute($db_connection, "update_last_access", array($user_id));
}

/**
 * Updates information about a student.
 * 
 * @param Database the database connection to query against.
 * @param Student the student to update.
 * 
 * @return User the student found, if any.
 */
function insert_new_registration($db_connection, 
    $first_name,
    $last_name,
    $email,
    $birth_date,
    $password,
    $program
)
{
    // Users insert stmt
    $insert_user = pg_prepare($db_connection, "insert_user_registration", 
        'INSERT INTO
            users
        VALUES
            first_name = $1,
            last_name = $2,
            email = $3,
            birth_date = $4,
            created_at = CURRENT_DATE,
            last_access = CURRENT_TIMESTAMP,
            password = $5'
        );

    // Students insert stmt
    $insert_student = pg_prepare($db_connection, "insert_user_registration", 
        'INSERT INTO
            students
        VALUES
            student_id = $1
            user_id = $2
            program = $3'
        );

    // Run user insert
    $insert_user = pg_execute($db_connection, "insert_user_registration", array($first_name, $last_name, $email, $birth_date, $password));

    // Grab user id generated and next student id (my quirk from bad db design in Lab 2)
    $user_id = retrieve_latest_user($db_connection);
    $student_id = get_next_student_id($db_connection);

    // Run student insert
    $insert_student = pg_execute($db_connection, "insert_user_registration", array($student_id, $user_id, $program));
}

/**
 * Retrieves the student with the most recent 'last access', or who has
 * most recently accessed the service.
 * 
 * @param Database the database connection to query against.
 * 
 * @return User the student found.
 */
function retrieve_latest_user($db_connection) 
{
    // Sorted select
    $latest_user = pg_prepare($db_connection, "latest_user", 
        'SELECT
            user_id
        FROM
            users
        ORDER BY
            last_access DESC'
        );
    
    // Run and return first row
    $latest_user = pg_execute($db_connection, "latest_user");
    return pg_fetch_result($latest_user, 0, "user_id");
}

/**
 * Looks at the students table and returns the next integer up from the
 * highest value student_id, ensuring uniqueness
 * 
 * @param Database the database connection to query against.
 * 
 * @return NextID the next student_id int to be used in the table.
 */
function get_next_student_id($db_connection) 
{
    // Sorted select
    $last_student = pg_prepare($db_connection, "last_student", 
    'SELECT
        student_id
    FROM
        students
    ORDER BY
        student_id DESC'
    );

// Run and return first row + 1
$last_student = pg_execute($db_connection, "last_student");
$last_student = pg_fetch_result($last_student, 0, "student_id");

return $last_student + 1;
}

/**
 * Gets the student id from $_POST
 * @return Student student, if set, otherwise an error string.
 */
function get_posted_student_id()
{
    // Check if student id is set
    if (isset($_POST['student_id']))
    {
        // If it is, return the value thats set
        return $_POST['student_id'];
    }

    else 
    {
        // Return error string
        return $GLOBALS['NO_STUDENT_PROVIDED'];
    }
}