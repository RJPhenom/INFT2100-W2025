/*
Robert Macklem
06_insert_user_data.sql
February 5, 2025
INFT2100 Winter 2025

Description:

Insert generated data into
the users table, based on 
Assignment #2's requirements

*/

-- Creates the crypt() extension for the password field
CREATE EXTENSION IF NOT EXISTS pgcrypto;

-- Insert script
INSERT INTO users (
    first_name,
    last_name,
    email,
    birth_date,
    created_at,
    last_access,
    password
    )

    -- This value written manually in class
    VALUES (
        'Robert',
        'Macklem',
        'robert.macklem@dcmail.ca',
        '1994-11-24',
        '2025-02-05',
        '2025-02-05 18:29:42',
        crypt('myPassword1$', gen_salt('bf'))
    )

    -- These values generated via ChatGPT
    ('John', 'Doe', 'john.doe@dcmail.ca', '1987-02-12', '2025-01-30', '2025-01-30 14:15:22', crypt('password123', gen_salt('bf'))),
    ('Alice', 'Johnson', 'alice.johnson@dcmail.ca', '1990-07-19', '2025-01-15', '2025-01-15 09:45:08', crypt('alice123', gen_salt('bf'))),
    ('Steve', 'Miller', 'steve.miller@dcmail.ca', '1985-03-22', '2025-01-25', '2025-01-25 20:07:30', crypt('steveMiller1$', gen_salt('bf'))),
    ('Linda', 'Smith', 'linda.smith@dcmail.ca', '1992-06-10', '2025-02-02', '2025-02-02 16:29:44', crypt('linda@123', gen_salt('bf'))),
    ('Mark', 'Taylor', 'mark.taylor@dcmail.ca', '1996-11-05', '2025-01-18', '2025-01-18 11:51:13', crypt('marktaylor#1', gen_salt('bf'))),
    ('Nina', 'Peterson', 'nina.peterson@dcmail.ca', '1993-04-29', '2025-02-03', '2025-02-03 08:14:02', crypt('nina#password1', gen_salt('bf'))),
    ('David', 'Lee', 'david.lee@dcmail.ca', '1989-08-07', '2025-02-01', '2025-02-01 12:38:27', crypt('davidLee@2025', gen_salt('bf'))),
    ('Megan', 'Wright', 'megan.wright@dcmail.ca', '1997-12-03', '2025-02-04', '2025-02-04 18:23:56', crypt('meganWright25!', gen_salt('bf'))),
    ('Carlos', 'Rodriguez', 'carlos.rodriguez@dcmail.ca', '1991-10-15', '2025-01-28', '2025-01-28 21:09:47', crypt('carlos@2025', gen_salt('bf'))),
    ('Samantha', 'Brown', 'samantha.brown@dcmail.ca', '1994-02-21', '2025-01-22', '2025-01-22 10:12:36', crypt('samanthaBrown2025', gen_salt('bf'))),
    ('Michael', 'Davis', 'michael.davis@dcmail.ca', '1982-09-12', '2025-01-14', '2025-01-14 08:57:22', crypt('michaelDavis#2025', gen_salt('bf'))),
    ('Sophia', 'Morris', 'sophia.morris@dcmail.ca', '1995-03-05', '2025-02-06', '2025-02-06 13:02:43', crypt('sophia@password', gen_salt('bf'))),
    ('James', 'Garcia', 'james.garcia@dcmail.ca', '1990-01-10', '2025-02-02', '2025-02-02 14:36:18', crypt('james#1234', gen_salt('bf'))),
    ('Isabella', 'Martinez', 'isabella.martinez@dcmail.ca', '1994-04-11', '2025-01-21', '2025-01-21 19:11:34', crypt('isabella2025$', gen_salt('bf'))),
    ('Benjamin', 'Hernandez', 'benjamin.hernandez@dcmail.ca', '1988-06-19', '2025-01-23', '2025-01-23 07:47:57', crypt('benjaminH123', gen_salt('bf'))),
    ('Ava', 'Lopez', 'ava.lopez@dcmail.ca', '1999-10-03', '2025-02-05', '2025-02-05 22:01:21', crypt('ava@Lopez1', gen_salt('bf'))),
    ('Ethan', 'Wilson', 'ethan.wilson@dcmail.ca', '1992-07-27', '2025-01-19', '2025-01-19 09:39:53', crypt('ethan@2025', gen_salt('bf'))),
    ('Charlotte', 'Anderson', 'charlotte.anderson@dcmail.ca', '1993-05-16', '2025-02-01', '2025-02-01 17:56:28', crypt('charlotte#password', gen_salt('bf'))),
    ('Matthew', 'Thomas', 'matthew.thomas@dcmail.ca', '1991-11-08', '2025-02-04', '2025-02-04 13:10:41', crypt('matthewT1234', gen_salt('bf'))),
    ('Zoe', 'Taylor', 'zoe.taylor@dcmail.ca', '1996-09-05', '2025-01-29', '2025-01-29 11:52:09', crypt('zoe#T2025', gen_salt('bf'))),
    ('Lucas', 'Jackson', 'lucas.jackson@dcmail.ca', '1990-05-13', '2025-02-03', '2025-02-03 08:34:51', crypt('lucas1234!', gen_salt('bf'))),
    ('Lily', 'White', 'lily.white@dcmail.ca', '1997-08-30', '2025-01-17', '2025-01-17 14:45:02', crypt('lily2025$', gen_salt('bf'))),
    ('Henry', 'Martinez', 'henry.martinez@dcmail.ca', '1984-03-24', '2025-02-02', '2025-02-02 16:29:42', crypt('henry#2025', gen_salt('bf'))),
    ('Grace', 'Young', 'grace.young@dcmail.ca', '1993-11-21', '2025-01-24', '2025-01-24 12:17:09', crypt('grace@2025', gen_salt('bf'))),
    ('Mason', 'Scott', 'mason.scott@dcmail.ca', '1989-10-12', '2025-01-20', '2025-01-20 19:04:36', crypt('mason1@scott', gen_salt('bf'))),
    ('Madison', 'Perez', 'madison.perez@dcmail.ca', '1994-01-25', '2025-02-04', '2025-02-04 16:57:22', crypt('madison#2025', gen_salt('bf'))),
    ('Oliver', 'Evans', 'oliver.evans@dcmail.ca', '1991-07-07', '2025-01-12', '2025-01-12 22:10:56', crypt('oliverEvans2025$', gen_salt('bf'))),
    ('Evelyn', 'Adams', 'evelyn.adams@dcmail.ca', '1990-12-17', '2025-01-27', '2025-01-27 10:28:19', crypt('evelyn@Adams1', gen_salt('bf'))),
    ('William', 'Baker', 'william.baker@dcmail.ca', '1987-04-03', '2025-01-29', '2025-01-29 08:51:43', crypt('william#2025', gen_salt('bf'))),
    ('Liam', 'Nelson', 'liam.nelson@dcmail.ca', '1995-02-20', '2025-02-06', '2025-02-06 13:03:22', crypt('liamNelson@1', gen_salt('bf'))),
    ('Natalie', 'Carter', 'natalie.carter@dcmail.ca', '1988-09-12', '2025-01-23', '2025-01-23 07:54:37', crypt('natalieCarter#1', gen_salt('bf'))),
    ('Luca', 'Parker', 'luca.parker@dcmail.ca', '1993-02-14', '2025-01-30', '2025-01-30 10:44:56', crypt('luca1234$', gen_salt('bf'))),
    ('Ella', 'Sullivan', 'ella.sullivan@dcmail.ca', '1992-11-29', '2025-02-02', '2025-02-02 16:35:24', crypt('ella@Sullivan1', gen_salt('bf'))),
    ('Owen', 'Roberts', 'owen.roberts@dcmail.ca', '1990-03-16', '2025-02-01', '2025-02-01 17:40:11', crypt('owen#2025', gen_salt('bf'))),
    ('Chloe', 'Morris', 'chloe.morris@dcmail.ca', '1995-05-25', '2025-01-11', '2025-01-11 21:01:58', crypt('chloe@2025', gen_salt('bf'))),
    ('Jack', 'Harris', 'jack.harris@dcmail.ca', '1988-06-05', '2025-02-02', '2025-02-02 14:02:35', crypt('jack#harris1', gen_salt('bf'))),
    ('Lily', 'Allen', 'lily.allen@dcmail.ca', '1993-08-16', '2025-01-20', '2025-01-20 15:28:47', crypt('lilyAll2025', gen_salt('bf'))),
    ('Maya', 'King', 'maya.king@dcmail.ca', '1991-09-10', '2025-01-30', '2025-01-30 16:19:04', crypt('mayaKing1$', gen_salt('bf'))),
    ('Gabriel', 'Gonzalez', 'gabriel.gonzalez@dcmail.ca', '1997-11-30', '2025-01-14', '2025-01-14 10:23:48', crypt('gabrielGonz2025', gen_salt('bf'))),
    ('Ruby', 'Morris', 'ruby.morris@dcmail.ca', '1995-04-02', '2025-01-12', '2025-01-12 17:09:11', crypt('rubyMorris#1', gen_salt('bf'))),
    ('Jaden', 'Phillips', 'jaden.phillips@dcmail.ca', '1992-03-19', '2025-02-06', '2025-02-06 21:18:23', crypt('jaden2025@phillips', gen_salt('bf'))),
    ('Sophie', 'Bennett', 'sophie.bennett@dcmail.ca', '1987-05-09', '2025-01-16', '2025-01-16 18:39:42', crypt('sophieBennett1', gen_salt('bf'))),
    ('Aaron', 'Moore', 'aaron.moore@dcmail.ca', '1994-12-28', '2025-02-03', '2025-02-03 19:22:34', crypt('aaronMoore#1', gen_salt('bf'))),
    ('Cameron', 'Morgan', 'cameron.morgan@dcmail.ca', '1990-11-07', '2025-01-19', '2025-01-19 08:47:10', crypt('cameronM2025', gen_salt('bf')))
    ('Samuel', 'Cameron', 'samuel.cameron@dcmail.ca', '1992-06-15', '2025-01-18', '2025-01-18 13:27:56', crypt('samuel2025#', gen_salt('bf'))),
    ('Aiden', 'Brooks', 'aiden.brooks@dcmail.ca', '1995-01-24', '2025-01-26', '2025-01-26 15:18:43', crypt('aiden@brooks1', gen_salt('bf'))),
    ('Ella', 'Diaz', 'ella.diaz@dcmail.ca', '1998-03-12', '2025-01-28', '2025-01-28 09:52:30', crypt('ella2025Diaz', gen_salt('bf'))),
    ('Lucas', 'Kelley', 'lucas.kelley@dcmail.ca', '1991-07-22', '2025-02-01', '2025-02-01 08:36:11', crypt('lucasK@2025', gen_salt('bf'))),
    ('Charlotte', 'Martinez', 'charlotte.martinez@dcmail.ca', '1986-12-04', '2025-01-22', '2025-01-22 14:47:19', crypt('charlotteM2025', gen_salt('bf'))),
    ('Nathan', 'Clark', 'nathan.clark@dcmail.ca', '1992-05-18', '2025-02-02', '2025-02-02 20:56:07', crypt('nathan#clark1', gen_salt('bf'))),
    ('Lillian', 'Reed', 'lillian.reed@dcmail.ca', '1997-02-10', '2025-01-30', '2025-01-30 22:12:43', crypt('lillianReed2025', gen_salt('bf'))),
    ('Dylan', 'Cook', 'dylan.cook@dcmail.ca', '1994-10-25', '2025-02-04', '2025-02-04 16:25:17', crypt('dylan@cook1', gen_salt('bf'))),
    ('Victoria', 'Morgan', 'victoria.morgan@dcmail.ca', '1993-11-17', '2025-02-03', '2025-02-03 13:18:56', crypt('victoria@M2025', gen_salt('bf'))),
    ('Isaac', 'Baker', 'isaac.baker@dcmail.ca', '1996-07-30', '2025-01-16', '2025-01-16 18:05:28', crypt('isaacBaker123', gen_salt('bf'))),
    ('Emily', 'Graham', 'emily.graham@dcmail.ca', '1997-09-14', '2025-01-29', '2025-01-29 21:38:03', crypt('emily2025@Graham', gen_salt('bf'))),
    ('Ethan', 'Nelson', 'ethan.nelson@dcmail.ca', '1994-12-19', '2025-01-21', '2025-01-21 10:11:49', crypt('ethan@Nelson1', gen_salt('bf'))),
    ('Liam', 'Johnson', 'liam.johnson@dcmail.ca', '1989-04-08', '2025-01-25', '2025-01-25 14:20:15', crypt('liam@2025johnson', gen_salt('bf'))),
    ('Madeline', 'Ross', 'madeline.ross@dcmail.ca', '1993-01-11', '2025-02-05', '2025-02-05 22:45:08', crypt('madeline2025$', gen_salt('bf'))),
    ('Zachary', 'Morris', 'zachary.morris@dcmail.ca', '1992-09-14', '2025-02-02', '2025-02-02 15:32:40', crypt('zacharyMorris2025', gen_salt('bf'))),
    ('Sofia', 'Barnes', 'sofia.barnes@dcmail.ca', '1995-08-17', '2025-01-17', '2025-01-17 20:09:34', crypt('sofiaBarnes#1', gen_salt('bf'))),
    ('Jacob', 'Rivera', 'jacob.rivera@dcmail.ca', '1986-11-26', '2025-02-01', '2025-02-01 13:22:11', crypt('jacobRivera#1', gen_salt('bf'))),
    ('Sophia', 'Ward', 'sophia.ward@dcmail.ca', '1998-05-08', '2025-01-13', '2025-01-13 11:42:55', crypt('sophiaWard#2025', gen_salt('bf'))),
    ('Benjamin', 'Stewart', 'benjamin.stewart@dcmail.ca', '1994-12-06', '2025-02-03', '2025-02-03 19:18:36', crypt('benjaminStewart1', gen_salt('bf'))),
    ('Harper', 'Hall', 'harper.hall@dcmail.ca', '1996-02-25', '2025-02-02', '2025-02-02 12:39:44', crypt('harperHall@2025', gen_salt('bf'))),
    ('Jack', 'Bennett', 'jack.bennett@dcmail.ca', '1995-01-07', '2025-01-31', '2025-01-31 20:56:50', crypt('jack@bennett2025', gen_salt('bf'))),
    ('Scarlett', 'Shaw', 'scarlett.shaw@dcmail.ca', '1991-03-04', '2025-01-21', '2025-01-21 07:32:23', crypt('scarlettShaw1', gen_salt('bf'))),
    ('Daniel', 'Russell', 'daniel.russell@dcmail.ca', '1989-02-17', '2025-02-06', '2025-02-06 10:09:52', crypt('danielRussell1', gen_salt('bf'))),
    ('Grace', 'Hughes', 'grace.hughes@dcmail.ca', '1993-09-23', '2025-01-14', '2025-01-14 11:41:02', crypt('grace#hughes2025', gen_salt('bf')))
;