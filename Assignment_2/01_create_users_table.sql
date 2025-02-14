/*
Robert Macklem
01_create_users_table.sql
February 5, 2025
INFT2100 Winter 2025

Description:

Create the users table, based on 
Assignment #2's requirements

*/

-- Drops to avoid duplicates
DROP TABLE IF EXISTS users;
DROP SEQUENCE IF EXISTS user_id_seq;

-- Creation script
CREATE SEQUENCE user_id_seq START 100900000;
CREATE TABLE users (
    user_id INT PRIMARY KEY DEFAULT nextval('user_id_seq'),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255) UNIQUE NOT NULL,
    birth_date DATE,
    created_at DATE,
    last_access TIMESTAMP,
    password VARCHAR(60)
);

-- Grants access to the professor
GRANT ALL ON users TO faculty;