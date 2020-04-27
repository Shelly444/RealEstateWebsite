--Group 09
--users.sql
--October 3 2018
--WEBD3201
-- DROP'ping tables clear out any existing data

DROP TABLE IF EXISTS users CASCADE;

CREATE TABLE users (
    user_id VARCHAR(50) PRIMARY KEY,
    password VARCHAR(32) NOT NULL,
    user_type VARCHAR(2) NOT NULL,
    email_address VARCHAR(256) NOT NULL,
    enrol_date DATE NOT NULL,
    last_access DATE NOT NULL
);
ALTER TABLE users OWNER TO group09_admin;

INSERT INTO users (user_id, password, user_type, email_address, enrol_date, last_access) 
VALUES 
    ('mariscalh', md5('password'), 's', 'hector.mariscal@dcmail.ca', '2018-10-28', '2018-10-28'),
    ('kirkwoodm', md5('password'), 'p', 'michelle.kirkwood@dcmail.ca', '2018-10-28', '2018-10-28'),
    ('zhengb', md5('password'), 'a', 'bo.zheng@dcmail.ca', '2018-10-28', '2018-10-28'),
    ('uchihas', md5('sharingan'), 'c', 'sasukeuchiha@gmail.com', '2018-10-28', '2018-10-28'),
    ('uzumakin', md5('rasengan'), 'c', 'narutouzumaki@hotmail.ca', '2018-10-28', '2018-10-28'),
    ('izukum', md5('fullcowling'), 'p', 'midoryiaizuku@durhamcollege.com', '2018-10-28', '2018-10-28'),
    ('mighta', md5('withasmile'), 'd', 'allmight@gmail.com', '2018-10-28', '2018-10-28');
