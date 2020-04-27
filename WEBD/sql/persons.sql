

DROP TABLE IF EXISTS persons;

CREATE TABLE persons(
	user_id VARCHAR(20) NOT NULL PRIMARY KEY,
	salutation VARCHAR(10) ,
	first_name VARCHAR(25) NOT  NULL,
	last_name VARCHAR(50) NOT  NULL,
	street_address_1 VARCHAR(75) ,
	street_address_2 VARCHAR(75) ,
	city VARCHAR(75) ,
	province VARCHAR(2) ,
	postal_code VARCHAR(6) ,
	primary_phone_number VARCHAR(15) NOT NULL,
	secondary_phone_number VARCHAR(15) ,
	fax_number VARCHAR(10) ,
	preferred_contact_method char(1) NOT  NULL
);
ALTER TABLE persons OWNER TO group09_admin;

INSERT INTO persons (user_id, salutation, first_name, last_name, street_address_1, street_address_2, city, province, postal_code, primary_phone_number, secondary_phone_number, fax_number, preferred_contact_method) 
VALUES 
    ('mariscalh', 'mr.', 'Hector', 'Mariscal', '48 Blah Street', '', 'Oshawa', 'ON', 'L1G8A3', '7049282133', '', '', 'e'),
    ('kirkwoodm', 'ms.', 'Michelle', 'Kirkwood', '48 Blah Street', '', 'Oshawa', 'ON', 'L1G8A3', '7049282133', '', '', 'e'),
    ('zhengb', 'mr.', 'Bo', 'Zheng', '48 Blah Street', '', 'Oshawa', 'ON', 'L1G8A3', '7049282133', '', '', 'e'),
    ('uchihas', 'mr.', 'Sam', 'Uchiha', '48 Blah Street', '', 'Oshawa', 'ON', 'L1G8A3', '7049282133', '', '', 'e'),
    ('uzumakin', 'mrs.', 'Nicole', 'Uzumaki', '48 Blah Street', '', 'Oshawa', 'ON', 'L1G8A3', '7049282133', '', '', 'e'),
    ('izukum', 'mr.', 'Matt', 'Izuku', '48 Blah Street', '', 'Oshawa', 'ON', 'L1G8A3', '7049282133', '', '', 'e'),
    ('mighta', 'mr.', 'Adam', 'Might', '48 Blah Street', '', 'Oshawa', 'ON', 'L1G8A3', '7049282133', '', '', 'e');