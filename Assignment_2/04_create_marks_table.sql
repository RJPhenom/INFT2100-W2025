/*
Robert Macklem
04_create_marks_table.sql
February 11, 2025
INFT2100 Winter 2025

Description:

Create the marks table, based on 
Assignment #2's requirements

*/

-- Drops to avoid duplicates
DROP TABLE IF EXISTS marks;

-- Creation script
CREATE TABLE marks (
    student_id INT NOT NULL, 
    course_code CHAR(8) NOT NULL, 
    final_mark INT CHECK (final_mark BETWEEN 0 AND 100) -- and a check constraint to bind data to 0-100

    -- keys
    PRIMARY KEY (student_id, course_code), -- composite key
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (course_code) REFERENCES courses(course_code) ON DELETE CASCADE
);

-- Grants access to the professor
GRANT ALL ON marks TO faculty;