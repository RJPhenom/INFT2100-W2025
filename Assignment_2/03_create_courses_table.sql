/*
Robert Macklem
01_create_courses_table.sql
February 11, 2025
INFT2100 Winter 2025

Description:

Create the courses table, based on 
Assignment #2's requirements

*/

-- Drops to avoid duplicates
DROP TABLE IF EXISTS courses;

-- Creation script
CREATE TABLE courses (
    course_code CHAR(8) PRIMARY KEY,
    course_description VARCHAR(255)
);

-- Grants access to the professor
GRANT ALL ON courses TO faculty;