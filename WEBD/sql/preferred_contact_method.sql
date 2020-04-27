


DROP TABLE IF EXISTS preferred_contact_method;

CREATE TABLE preferred_contact_method(
value CHAR(1) PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

INSERT INTO preferred_contact_method(value, property) 
VALUES 
    ('e', 'E-mail'),
    ('p', 'Phone call'),
    ('l', 'Letter post'),
    ('f', 'Fax');
