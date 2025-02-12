/*
Robert Macklem
06_insert_user_data.sql
February 5, 2025
INFT2100 Winter 2025

Description:

Create the users table, based on 
Assignment #2's requirements

*/

INSERT INTO 
    users (
    first_name,
    last_name,
    email,
    birth_date,
    created_at,
    last_access,
    password
    )

    VALUES (
        'Robert',
        'Macklem',
        'robert.macklem@dcmail.ca',
        '1994-11-24',
        '2025-02-05',
        '2025-02-05 18:29:42',
        'password',
    );