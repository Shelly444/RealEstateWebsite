DROP TABLE IF EXISTS building_types CASCADE;

CREATE TABLE building_types(
    value         INT          PRIMARY KEY,
    property      VARCHAR      NOT NULL
);

ALTER TABLE building_types OWNER TO group09_admin;

INSERT INTO building_types (value, property) 
VALUES 
    (1,'House'),
    (2,'Townhouse'),
    (4,'Duplex'),
    (8,'Condo'),
    (16,'Triplex'),
    (32,'Apartment'),
    (64,'Recreational'),
    (128,'Mobile Home'),
    (256,'Other');
