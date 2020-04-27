DROP TABLE IF EXISTS bedrooms;

CREATE TABLE bedrooms(
value INTEGER PRIMARY KEY,
Property VARCHAR NOT NULL
);

ALTER TABLE bedrooms OWNER TO group09_admin;

INSERT INTO bedrooms (value, property) 
VALUES 
    (1, '1'),
    (2, '2'),
    (4, '3'),
    (8, '4'),
    (16, '5'),
    (32, '6'),
    (64, '7');
