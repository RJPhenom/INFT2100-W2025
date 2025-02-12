
/*
Robert Macklem
09_crud_examples.sql
February 11, 2025
INFT2100 Winter 2025

Description:

Manually write out statements demonstrating
CRUD procedures according to Assignment #2
requirements.

*/

-- 3 Insert examples for users
INSERT INTO users (
    first_name,
    last_name,
    email,
    birth_date,
    created_at,
    last_access,
    password
    )


    VALUES 
    (
        'Greg',
        'Orrey',
        'greg.orrey@dcmail.ca',
        '1993-03-03',
        '2025-02-11',
        '2025-02-11 23:29:42',
        crypt('gregOrreysPassword1$', gen_salt('bf'))
    )
    (
        'Bamboo',
        'Pandaman',
        'bamboo.pandaman1@dcmail.ca',
        '1983-08-02',
        '2025-02-11',
        '2025-02-11 23:30:52',
        crypt('pandasRule1!', gen_salt('bf'))
    )
    (
        'Geralt',
        'OfRivia',
        'geralt.ofrivia@dcmail.ca',
        '2007-10-30',
        '2025-02-11',
        '2025-02-11 23:32:26',
        crypt('m0nst3rHUNT3R%!', gen_salt('bf'))
    )
;

-- SELECT without WHERE
SELECT * 
FROM users
;

-- SELECT with WHERE
SELECT 
    first_name, 
    last_name, 
    email 
FROM users 
WHERE email LIKE '%@%'
;

-- SELECT with ORDER BY
SELECT 
    first_name, 
    last_name,
    user_id,
    created_at,
    last_access
FROM users
ORDER BY last_access
;

-- UPDATE with WHERE
UPDATE users
SET
    last_access = '2025-02-12 00:23:25'
WHERE 
    user_id = 100900001
;

-- DELETE with WHERE
-- (1/2)
DELETE FROM users 
WHERE user_id = 100900070
;

-- (2/2)
DELETE FROM users
WHERE first_name = 'Geralt' AND last_name = 'OfRivia'
;

-- INSERT into courses
INSERT INTO courses (
    'ABCD1234',
    'Its as easy as 123'
)
;

-- SELECT students with marks >80
SELECT DISTINCT student_id
FROM marks
WHERE final_mark > 80;
;

-- UPDATE a course description on the new course
UPDATE courses
SET course_description = 'do re mi, A B C, 1 2 3'
WHERE course_code = 'ABCD1234'
;

-- DELETE a student based on id
DELETE FROM users
WHERE user_id = 100900069
;
