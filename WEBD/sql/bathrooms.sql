DROP TABLE IF EXISTS bathrooms;

CREATE TABLE bathrooms(
value INTEGER,
property VARCHAR NOT NULL
);

ALTER TABLE bathrooms OWNER TO group09_admin;

INSERT INTO bathrooms (value, property) 
VALUES 
    (1, '1'),
    (2, '2'),
    (4, '3'),
    (8, '4'),
    (16, '5');
