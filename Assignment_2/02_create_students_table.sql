/*
Robert Macklem
01_create_students_table.sql
February 11, 2025
INFT2100 Winter 2025

Description:

Create the students table, based on 
Assignment #2's requirements

*/

-- Drops to avoid duplicates
DROP TABLE IF EXISTS students;
DROP SEQUENCE IF EXISTS student_id_seq;

-- Creation script
CREATE SEQUENCE student_id_seq START 1;
CREATE TABLE students (
    student_id INT PRIMARY KEY,
    user_id INT UNIQUE NOT NULL, 
    program_code CHAR(4),

    -- foreign key constraint
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Grants access to the professor
GRANT ALL ON students TO faculty;