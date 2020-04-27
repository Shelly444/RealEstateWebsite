

DROP TABLE IF EXISTS floors;

CREATE TABLE floors(
value SMALLINT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE floors OWNER TO group09_admin;

INSERT INTO floors (value, property) VALUES (1, 'one floor');

INSERT INTO floors (value, property) VALUES (2, 'two floors');

INSERT INTO floors (value, property) VALUES (4, 'three floors');

