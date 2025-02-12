/*
Robert Macklem
06_insert_courses_data.sql
February 11, 2025
INFT2100 Winter 2025

Description:

Insert generated datat into 
the courses table, based on 
Assignment #2's requirements

*/

-- Insert formatted manually
INSERT INTO courses (
    course_code, 
    course_description
    ) 

    -- Values pased in from ChatGPT
    VALUES
    ('COMM1100', 'Communication Foundations'),
    ('COMP1116', 'Computer Systems - Hardware'),
    ('COSC1100', 'Introduction to Programming'),
    ('INFT1104', 'Data Communications and Networking 1'),
    ('INFT1105', 'Introduction to Databases'),
    ('MATH1114', 'Mathematics for IT'),
    ('COSC1200', 'Object-Oriented Programming 1'),
    ('GNED0000', 'General Education Elective'),
    ('INFT1206', 'Web Development - Fundamentals'),
    ('INFT1207', 'Software Testing and Automation'),
    ('MGMT1223', 'Systems Development 1'),
    ('MGMT1224', 'Business for IT Professionals'),
    ('COMM2109', 'IT Career Essentials'),
    ('COSC2100', 'Object-Oriented Programming 2'),
    ('INFT2100', 'Web Development Intermediate'),
    ('INFT2101', 'Database Development 1'),
    ('MGMT2107', 'Systems Development 2'),
    ('COSC2200', 'Object-Oriented Programming 3'),
    ('INFT2200', 'Mainframe Development 1'),
    ('INFT2201', 'Web Development - Enterprise'),
    ('INFT2202', 'Web Development - Client Side Script'),
    ('INFT2203', 'Cloud Technology Fundamentals'),
    ('INFT3100', 'Mainframe Development 2'),
    ('INFT3101', 'Mobile Development'),
    ('INFT3102', 'Web Development - Frameworks'),
    ('INFT3103', 'Emerging Technologies'),
    ('INFT3104', 'Cloud Technology for Developers'),
    ('CPGA3200', 'Capstone Project'),
    ('CPGA3201', 'Field Placement - CPA'),
    ('INFT3200', 'Cloud Technology Operations'),
    ('INFT3201', 'Database Development 2'),
    ('MGMT3211', 'Cross-Functional Collaboration')
;